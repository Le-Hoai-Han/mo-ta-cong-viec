<?php

namespace App\Models\KhachHang;

use App\Models\NhomKhachHang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietKhachHang extends Model
{
    use HasFactory;

    protected $table = 'kh___chi_tiet_khach_hang';

    public function moiQuanHe(){
        return $this->belongsTo(MoiQuanHeKhachHang::class,'id_moi_quan_he','id');
    }

    public function danhSachNhomKH(){
        return $this->belongsToMany(NhomKhachHang::class,'kh___chi_tiet_nhom_kh','id_khach_hang','id_loai_khach_hang','id_khach_hang','id');
    }
}
