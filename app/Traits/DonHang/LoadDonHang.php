<?php

namespace App\Traits\DonHang;

use App\Models\DonHang\DonHang;
use App\Models\KhachHang;
use App\Models\Thuong\DonHangThuongMoMoi;
use App\Models\Thuong\ThuongMoMoi;
use App\Models\Thuong\TMMDonHangKhachHang;

trait LoadDonHang
{
    /**
     * load don hang theo ma don hang
     */
    public function loadDonHang($maDonHang) : ?DonHang
    {
        return DonHang::where([
            ['ma_don_hang','=',$maDonHang]
        ])->first();
    }

    public function loadKhachHangMoMoi($idKhachhang)
    {
        $donHangTMM=TMMDonHangKhachHang::where([
            ['id_khach_hang','=',$idKhachhang]
        ])->first();
        if(!empty($donHangTMM)){
            return $donHangTMM;
        }
        return null;
    }

     //load don hang thưởng mở mới theo ma don hang
     public function _loadDonHangThuongMoMoi($idDonHang)
     {
         return DonHangThuongMoMoi::where([
             'id_don_hang' => $idDonHang
         ])->first();
     }
}