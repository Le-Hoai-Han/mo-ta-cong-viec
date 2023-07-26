<?php

namespace App\Traits\KhachHang;

use App\Models\DonHang\DonHang;
use App\Traits\ParseDataKH;
use App\Traits\XoaGachChanTen;

trait ThongTinKhachHang
{
    use ParseDataKH;
    use XoaGachChanTen;
    
    public function timNguoiLienHe(DonHang $donHang,$listNguoiLienHe) : array
    {
        // Tìm ds người liên hệ
        // $listNguoiLienHe = $this->layDanhSachNguoiLienHe($listNguoiLienHe);

        // Bỏ khoảng trắng của người liên hệ đơn hàng
        $tenNguoiLienHeDH = $this->xoaGachChanTen($donHang->ten_nguoi_lien_he);
    
    
        $nguoiLienHe=[];
        foreach($listNguoiLienHe as $lienHe){
            // tách danh xưng và so sánh với người liên hệ của đơn hàng
            $danhXung = $this->timDanhXungKH($lienHe->ho_va_ten);

            
            //bo danh xung va khoang trang dau cuoi de so sanh voi nguoi lien he don han    
            $tenLienHeHienTai=trim(str_replace($danhXung,' ',$lienHe->ho_va_ten));
            $tenLienHeHienTai=trim(str_replace('.',' ',$lienHe->ho_va_ten));         
            if($tenLienHeHienTai == $tenNguoiLienHeDH){
                $nguoiLienHe=[
                    'ho_va_ten'=>$tenLienHeHienTai,
                    'email'=>$lienHe->email
                ];
                break;
            }
        }
        return  $nguoiLienHe;
    }

    /**
     * tim danh xung nguoi lien he 
     * match (Mr) hoặc (Mrs)
     */
    public function timDanhXungKH($tenLienHe) : string 
    {
        preg_match_all ("/\(((\S)+)\)$/m", $tenLienHe,$chuoiKetQua);
        // dd($chuoiKetQua);
        if(!empty($chuoiKetQua[0][0])){
            return $chuoiKetQua[0][0];
        }

        if(!empty($chuoiKetQua[0])){
            return $chuoiKetQua[0];
        }
        return "";
    }

    public function checkIDKhachHang($idKhachHang){
        $reg="/".config('services.khach-hang.id_khach_hang_khong_tinh_thuong')."/i";
        return preg_match($reg,$idKhachHang);
    }
}