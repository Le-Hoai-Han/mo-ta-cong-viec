<?php

namespace App\Traits\DonHang;

use App\Models\DonHang\DonHang;

trait DonHangThanhToanDuNhanVien
{
    /**
     * lay ds don hang duoc nhan vien tao 
     */
    public function getDsDonHangNhanVien($idNhanVien) : array
    {
         return DonHang::select('id')
            ->where('id_nhan_vien',$idNhanVien)
            ->where('da_thanh_toan',DonHang::DA_THANH_TOAN_DU)
            ->where('duoc_tinh_thuong',DonHang::DUOC_TINH_THUONG)
            ->whereNotIn('trang_thai',[DonHang::TT_HUY,DonHang::TT_MOI])
            ->get()
            ->pluck('id')
            ->toArray();
    }
    
}