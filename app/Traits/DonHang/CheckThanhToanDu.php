<?php

namespace App\Traits\DonHang;

use App\Models\DonHang\DonHang;

trait CheckThanhToanDu
{
    /**
     * check don hang thanh toan du
     */
    public function checkThanhToanDu(DonHang $donHang) : bool 
    {
        $tongSoTienThanhToan = $donHang->thanhToanThuocDonHang->sum('so_tien_thanh_toan');
        if($donHang->doanh_thu <= $tongSoTienThanhToan) {
            return true;
        }
        return false;
    }
}