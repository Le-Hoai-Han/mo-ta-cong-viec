<?php 

namespace App\Services\NhanVien;


class NhanVienService 
{
    public function updateThongTinNhanVien($nhanVien,$name,$nhomNhanVien,$trangThai) : bool
    {
        $nhanVien->ho_ten = $name;
        $nhanVien->id_nhom_nhan_vien = $nhomNhanVien;
        $nhanVien->group = $nhanVien->nhomNhanVien->ma_nhom;
        $nhanVien->da_xoa = $trangThai;
        if($nhanVien->save()) {
            return true;
        } else {
            return false;
        }
    }
}