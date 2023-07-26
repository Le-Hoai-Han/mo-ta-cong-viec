<?php

namespace App\Traits\DonHang;

use App\Models\DonHang\DonHang;

trait TrangThaiDonNoXauTrait
{
    /**
     * kiem tra nguoi phu trach co thuoc vao nhom admin hoac khong gui mail hay khong
     */
    public function trangThaiDonNoXau(DonHang $donHang) : bool
    {
        //danh sach id user he thong 
        $dsTrangThaiCoNoXau = [
            DonHang::TT_MOI,
            DonHang::TT_THANH_TOAN,
            DonHang::TT_DUYET,
            DonHang::TT_DA_XUAT_HET
        ];

        // neu trang thai thuoc mang nay thi return true;
        if(in_array($donHang->trang_thai,$dsTrangThaiCoNoXau))
            return true;
        return false;            
    }
}