<?php

namespace App\Models;

use App\Models\DonHang\DonHang;
use App\Models\KhachHang\ChiTietKhachHang;
use App\Models\Thuong\ThuongMoMoi;
use App\Models\Thuong\TMMDonHangKhachHang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhachHang extends Model
{
    use HasFactory;
    protected $table="kh___khach_hang";

    public function listDonHang(){
        return $this->hasMany(DonHang::class,'id_khach_hang','id');
    }

    public function TMMDonHangKhachHang(){
        return $this->hasOne(TMMDonHangKhachHang::class,'id_khach_hang','id');
    }

    public function chiTietKhachHang(){
        return $this->hasOne(ChiTietKhachHang::class,'id_khach_hang','id');
    }

    public function lienHeKhachHang(){
        return $this->hasMany(LienHeKhachHang::class,'id_khach_hang','id');
    }

}
