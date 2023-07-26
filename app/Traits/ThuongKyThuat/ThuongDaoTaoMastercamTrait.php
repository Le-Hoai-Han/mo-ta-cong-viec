<?php
namespace App\Traits\ThuongKyThuat;

use App\Models\DonHang\DanhMucSanPham;
use App\Models\DonHang\DonHang;
use App\Models\ThuongKyThuat\LoaiThuongKyThuat;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;

trait ThuongDaoTaoMastercamTrait
{
    private function _getIDLoaiDaoTaoMastercam() : int 
    {
        $loai = LoaiThuongKyThuat::where('ma_loai',ThuongKyThuatDonHang::LOAI_MASTERCAM_DAO_TAO)->first();
        return $loai->id;
    }

    /**
     * tinh thuong dao tao mastercam
     */
    public function tinhThuongDaoTaoMastercam(DonHang $donHang) : void 
    {
        if($this->kiemTraThuongDaoTaoMastercam($donHang)) {
            $this->capNhatThuongDaoTaoMastercam($donHang);
        } else {
            
            $this->xoaThuongDaoTaoMastercam($donHang);
        }
    }


    /**
     * kiem tra co thuong dao tao hay ko 
     */
    public function kiemTraThuongDaoTaoMastercam(DonHang $donHang) : bool 
    {
        if($donHang->sanPhams->isEmpty()) {
            return false; 
        }

        $sanPhamThuocDonHang = $donHang->sanPhams;

        /**
         * neu khong co san pham mastercam thi khong thuong
         */
        $slSanPhamMastercam = $sanPhamThuocDonHang->filter(function($sanPham) {            
            return $sanPham->danhMucSanPham->id_loai_san_pham === DanhMucSanPham::DANH_MUC_MASTERCAM;

        })->count();

        if($slSanPhamMastercam == 0) {
            return false;
        }

        /**
         * neu co san pham mastercam ma khong dao tao thi khong thuong
         */
        $idDVDaoTao = DanhMucSanPham::getIDDaoTaoCongNghe();
        $slSanPhamDaoTao = $sanPhamThuocDonHang->filter(function($sanPham) use ($idDVDaoTao) {
            return $sanPham->id_san_pham === $idDVDaoTao;
        })->count();

        if($slSanPhamDaoTao == 0)
        {
            return false;
        }

        return true; 
    }

    /**
     * xoa thuong mastercam neu khong dat dieu kien
     */
    protected function xoaThuongDaoTaoMastercam(DonHang $donHang) {
        $thuongMastercam = ThuongKyThuatDonHang::where([
            'id_loai' => $this->_getIDLoaiDaoTaoMastercam(),
            'id_don_hang' => $donHang->id
        ])->first();
        if($thuongMastercam) {
            $thuongMastercam->delete();
        }
    }

    /**
     * cap nhat thuong dao tao mastercam
     */
    protected function capNhatThuongDaoTaoMastercam($donHang) : void 
    {
        $thuongMastercam = ThuongKyThuatDonHang::firstOrNew([
            'id_don_hang'=>$donHang->id,
            'id_loai' => $this->_getIDLoaiDaoTaoMastercam()
        ]);

        $soTienTinhThuong = $donHang->sanPhams->sum('so_tien_tinh_thuong');
        
        $thuongMastercam->so_tien_thuong = ($soTienTinhThuong*1.5)/100;
        $thuongMastercam->mo_ta = 'Thưởng đào tạo Mastercam: 1.5% của '.thuGonSoLe($soTienTinhThuong).' là '.thuGonSole($thuongMastercam->so_tien_thuong).'đ';
        $thuongMastercam->ngay_cap_nhat = date('Y-m-d H:i:s');
        $thuongMastercam->save();


    }
}