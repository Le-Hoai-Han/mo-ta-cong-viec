<?php 

namespace App\Services\DonHang;

use App\Models\DonHang\ThanhToanThuocDonHang;

class ThanhToanService 
{

    //luu thanh toan thuoc don hang
    public function store($donHang,$soTienThanhToan,$ngayThanhToan) {
        $thanhToan = new ThanhToanThuocDonHang();
        $thanhToan->id_don_hang = $donHang->id;
        $thanhToan->so_tien_thanh_toan = formatGiaTriDeLuu($soTienThanhToan);
        $thanhToan->ngay_thanh_toan = formatNgayDeLuu($ngayThanhToan);
        if($thanhToan->save()) {
            return true;
        }
        return false;
    }

    //update thanh toan thuoc don hang
    public function update($thanhToan, $donHang, $soTienThanhToan, $ngayThanhToan) {
        $thanhToan->id_don_hang = $donHang->id;
        $thanhToan->so_tien_thanh_toan = formatGiaTriDeLuu($soTienThanhToan);
        $thanhToan->ngay_thanh_toan = formatNgayDeLuu($ngayThanhToan);
        $thanhToan->da_cap_nhat = 1;
        if($thanhToan->save()) {
            return true;
        }
        return false;
    }

    
}
