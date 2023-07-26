<?php
namespace App\Traits\ThuongKyThuat;

use App\Models\DonHang\DanhMucSanPham;
use App\Models\DonHang\DonHang;
use App\Models\ThuongKyThuat\LoaiThuongKyThuat;
use App\Models\ThuongKyThuat\SoTienThuongKyThuat;
use App\Models\ThuongKyThuat\SoTienThuongKyThuatTheoSanPham;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;

trait ThuongDaoTaoGeomagicTrait
{
    /**
     * tinh thuong dao tao mastercam
     */
    public function tinhThuongDaoTaoGeomagic(DonHang $donHang) : void 
    {
        if($this->kiemTraThuongDaoTaoGeomagic($donHang)) {
           

            $this->capNhatThuongDaoTaoGeomagic($donHang);
        } else {
            
            $this->xoaThuongDaoTaoGeomagic($donHang);
        }
    }

    /**
     * danh sach id loai dao tao geomagic
     */
    private function _getIDLoaiDaoTaoGeomagic() : array 
    {
        /**
         * tra ve dng [GEOMAGIC_5T=>id]
         */
  
        return LoaiThuongKyThuat::whereIn('ma_loai',ThuongKyThuatDonHang::LOAI_GEOMAGIC)->get()->flatten()->keyBy('ma_loai')->map(function($loai){return $loai->id;})->toArray();
        


    }

    /**
     * lay danh muc san pham geomagic duoc tinh thuong
     * tra ve danh sach id san pham
     */
    private function _danhMucSanPhamGeomagicTinhThuong() : array 
    {
        $dsSanPham = DanhMucSanPham::whereIn('dong_san_pham',ThuongKyThuatDonHang::LOAI_GEOMAGIC)->get()->pluck('id')->toArray();
        return $dsSanPham;
    }

    /**
     * kiem tra co thuong dao tao hay ko 
     */
    public function kiemTraThuongDaoTaoGeomagic(DonHang $donHang) : bool 
    {
        if($donHang->sanPhams->isEmpty()) {
            return false; 
        }

        $sanPhamThuocDonHang = $donHang->sanPhams;
        $dsSanPhamGeomagic = $this->_danhMucSanPhamGeomagicTinhThuong();
        /**
         * neu khong co san pham mastercam thi khong thuong
         */
        $slSanPhamGeomagic = $sanPhamThuocDonHang->filter(function($sanPham) use ($dsSanPhamGeomagic) {            
            return in_array($sanPham->id_san_pham,$dsSanPhamGeomagic);

        })->count();
        if($slSanPhamGeomagic == 0) {
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
     * xoa thuong geomagic neu khong dat dieu kien
     */
    protected function xoaThuongDaoTaoGeomagic(DonHang $donHang) {
        $dsThuongGeomagic = ThuongKyThuatDonHang::where([            
            'id_don_hang' => $donHang->id
        ])->whereIn('id_loai',$this->_getIDLoaiDaoTaoGeomagic())->get();
        if($dsThuongGeomagic) {
            foreach($dsThuongGeomagic as $thuongGeomagic) {
                $thuongGeomagic->delete();
            }
            
        }
    }

    /**
     * cap nhat thuong dao tao geomagic
     */
    protected function capNhatThuongDaoTaoGeomagic($donHang) : void 
    {
        $dsSanPham = $donHang->sanPhams;
        $dsLoaiThuong = $this->_getIDLoaiDaoTaoGeomagic();
        foreach($dsSanPham as $sanPham) {
            if($sanPham->danhMucSanPham->checkThuongGeomagic()) {
                $sanPhamThuong = SoTienThuongKyThuatTheoSanPham::where('id_san_pham',$sanPham->id_san_pham)
                    ->whereRelation('soTienThuong', 'dang_su_dung',SoTienThuongKyThuat::TT_DANG_SU_DUNG)
                    ->first();
                if($sanPhamThuong!=null) {
                    $soTienThuongKyThuat = $sanPhamThuong->soTienThuong;
                    if(in_array($soTienThuongKyThuat->mo_ta,ThuongKyThuatDonHang::LOAI_GEOMAGIC)) {
                        $thuongKyThuatDonHang = ThuongKyThuatDonHang::firstOrNew([
                            'id_loai' => $dsLoaiThuong[$soTienThuongKyThuat->mo_ta],
                            'id_don_hang' => $donHang->id
                        ]);
    
                        $thuongKyThuatDonHang->so_tien_thuong = $soTienThuongKyThuat->tien_thuong_vuot_muc;
                        $thuongKyThuatDonHang->mo_ta = "Thưởng đào tạo: ".$sanPham->danhMucSanPham->ten_san_pham." số tiền là ". thuGonSoLe($thuongKyThuatDonHang->so_tien_thuong).'đ';
                        $thuongKyThuatDonHang->ngay_cap_nhat = date('Y-m-d H:i:s');
                        $thuongKyThuatDonHang->save();
                    }
                }    
                
            }
            
        }

    }

   
}