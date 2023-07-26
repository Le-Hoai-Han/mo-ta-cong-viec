<?php

namespace App\Models\CongThuc;

use App\Models\NhatKyCapNhatHeThong;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachBienSo extends Model
{
    use HasFactory;
    protected $table = 'cms___danh_sach_bien_so';
    protected $fillable = [
        'ten_bien',
        'gia_tri',
        'mo_ta',
        'kieu_du_lieu'
    ];

    public function danhSachCongThuc() {
        return $this->belongsToMany(DanhSachBienSo::class,'cms___bien_so_thuoc_cong_thuc','id_bien_so','id_cong_thuc');
    }

    public function thongTinCapNhats()
    {
        return $this->morphMany(NhatKyCapNhatHeThong::class, 'thongTinCapNhat');
    }
}
