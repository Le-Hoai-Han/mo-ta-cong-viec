<?php

namespace App\Models\ThuongKyThuat;

use App\Models\DonHang\DanhMucSanPham;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SoTienThuongKyThuatTheoSanPham extends Model
{
    public $table = 'kt___so_tien_thuong_ky_thuat_theo_san_pham';

    public function sanPham() : BelongsTo
    {
        return $this->belongsTo(DanhMucSanPham::class,'id_san_pham','id');
    }

    public function soTienThuong() : BelongsTo
    {
        return $this->belongsTo(SoTienThuongKyThuat::class,'id_so_tien_thuong','id');
    }
}
