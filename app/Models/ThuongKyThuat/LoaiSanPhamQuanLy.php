<?php

namespace App\Models\ThuongKyThuat;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\DonHang\LoaiSanPham;
use App\Traits\ThuocLoaiSanPham;
use App\Traits\ThuocNhomNhanVien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LoaiSanPhamQuanLy extends Model
{
    use ThuocNhomNhanVien;
    use ThuocLoaiSanPham;
    // use HasFactory;
    public $table = 'kt___loai_san_pham_quan_ly';

    public $timestamps = false;

    public $fillable = [
        'id_loai_san_pham',
        'id_nhom_nhan_vien'
    ];

    public function loaiSanPham() : BelongsTo
    {
        return $this->belongsTo(LoaiSanPham::class,'id_loai_san_pham');
    }

}
