<?php
namespace App\Traits\ThuongKyThuat;

use App\Models\DonHang\DanhMucSanPham;
use App\Models\DonHang\DonHang;
use App\Models\ThuongKyThuat\LoaiThuongKyThuat;
use App\Models\ThuongKyThuat\SoTienThuongKyThuat;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;

trait ThuongCaiDatMastercamTrait
{
    private function _getIDLoaiCaiDatMastercam() : int 
    {
        $loai = LoaiThuongKyThuat::where('ma_loai',ThuongKyThuatDonHang::LOAI_MASTERCAM_LC)->first();
        return $loai->id;
    }

    public function tinhThuongCaiDatMastercam(DonHang $donHang) : void 
    {
        if($this->kiemTraThuongCaiDatMastercam($donHang)) {
            $this->capNhatThuongCaiDatMastercam($donHang);
        } else {
            $this->xoaThuongCaiDatMastercam($donHang);
        }
    }

    /**
     * khach hang la Mastercam VN thi tinh
     */
    public function kiemTraThuongCaiDatMastercam(DonHang $donHang) : bool
    {
        if($donHang->sanPhams->isEmpty()) {
            return false;
        }
        return $donHang->id_khach_hang == ThuongKyThuatDonHang::MA_KH_MASTERCAM;        
    }

    /**
     * xoa thuong cai dat mastercam 
     */
    protected function xoaThuongCaiDatMastercam(DonHang $donHang) : void 
    {
        $thuongCaiDatMastercam = ThuongKyThuatDonHang::where([
            'id_don_hang'=>$donHang->id,
            'id_loai' => $this->_getIDLoaiCaiDatMastercam()
        ])->first();

        if($thuongCaiDatMastercam) {
            $thuongCaiDatMastercam->delete();
        }
    }

    /**
     * cap nhat thuong cai dat Mastercam LC
     */
    protected function capNhatThuongCaiDatMastercam(DonHang $donHang) : void 
    {
        $thuongCaiDatMastercam = ThuongKyThuatDonHang::firstOrNew([
            'id_don_hang'=>$donHang->id,
            'id_loai' => $this->_getIDLoaiCaiDatMastercam()
        ]);

        $soLuongSanPhamMastercam = $donHang->sanPhams->filter(function($sanPham){
            return $sanPham->danhMucSanPham->id_loai_san_pham === DanhMucSanPham::DANH_MUC_MASTERCAM;
        })->sum('so_luong');

        $soTienThuongLapDatMastercam = SoTienThuongKyThuat::where([
                ['mo_ta','=','MASTERCAM'],
                ['dang_su_dung','=',SoTienThuongKyThuat::TT_DANG_SU_DUNG],
            ])->first();

        $moTa = '';
        $soTienThuong = 0;

        if($soLuongSanPhamMastercam == 0) {
            $soTienThuong = 0;
        } else if($soLuongSanPhamMastercam <= $soTienThuongLapDatMastercam->so_luong_gioi_han) {
            $soTienThuong = $soTienThuongLapDatMastercam->tien_thuong_co_ban * $soLuongSanPhamMastercam;
            $moTa = 'Thưởng cài đặt '.$soLuongSanPhamMastercam.' license: '.$soTienThuong.'đ';
        } else {
            $soTienThuongCoBan = $soTienThuongLapDatMastercam->tien_thuong_co_ban * $soTienThuongLapDatMastercam->so_luong_gioi_han;
            $soLuongVuotMuc = $soLuongSanPhamMastercam - $soTienThuongLapDatMastercam->so_luong_gioi_han;
            $soTienThuongVuotMuc = $soTienThuongLapDatMastercam->tien_thuong_vuot_muc * $soLuongVuotMuc;
            $soTienThuong = $soTienThuongCoBan + $soTienThuongVuotMuc;
            // dd($soTienThuongVuotMuc);
            $moTa = 'Thưởng cài đặt '.$soTienThuongLapDatMastercam->so_luong_gioi_han.' license: '.$soTienThuongCoBan.'đ<br>Thưởng '.$soLuongVuotMuc.' (từ '.$soTienThuongLapDatMastercam->so_luong_gioi_han.' license trở lên): '.$soTienThuongVuotMuc.'đ';
        }

        $thuongCaiDatMastercam->so_tien_thuong = $soTienThuong; 
        $thuongCaiDatMastercam->mo_ta = $moTa;
        $thuongCaiDatMastercam->ngay_cap_nhat = date('Y-m-d');
        $thuongCaiDatMastercam->save();

        
    }
}