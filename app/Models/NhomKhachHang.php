<?php

namespace App\Models;

use App\Models\KhachHang\ChiTietKhachHang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhomKhachHang extends Model
{
    use HasFactory;
    protected $table="kh___danh_muc_loai_khach_hang";
    protected $fillable=[
        'id',
        'ten_loai'
    ];

    public function khachHangs(){
        return $this->belongsToMany(ChiTietKhachHang::class,'kh___chi_tiet_nhom','id_loai_khach_hang','id_khach_hang','id','id_khach_hang');
    }
}
