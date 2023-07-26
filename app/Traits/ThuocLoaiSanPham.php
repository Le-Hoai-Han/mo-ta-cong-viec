<?php

namespace App\Traits;

use App\Models\DonHang\LoaiSanPham;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ThuocLoaiSanPham
{
    /**
     * thuoc loai san pham
     */
    public function loaiSanPham() : BelongsTo
    {
        return $this->belongsTo(LoaiSanPham::class,'id_loai_san_pham','id');
    }
}
