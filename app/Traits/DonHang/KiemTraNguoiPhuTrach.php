<?php

namespace App\Traits\DonHang;

use App\Models\DonHang\DonHang;

trait KiemTraNguoiPhuTrach
{
    /**
     * kiem tra nguoi phu trach co thuoc vao nhom admin hoac khong gui mail hay khong
     */
    public function nguoiPhuTrachLaUserHeThong($idNguoiPhuTrach) : bool
    {
        //danh sach id user he thong 
        $dsIdHeThong = [
            DonHang::ID_USER_ROOT,
            DonHang::ID_USER_3DM,
            DonHang::ID_USER_3DS
        ];

        // neu nguoi tao thuoc mang nay thi return false;
        if(in_array($idNguoiPhuTrach,$dsIdHeThong))
            return true;
        return false;            
    }
}