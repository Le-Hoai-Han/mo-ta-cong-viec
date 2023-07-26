<?php

namespace App\Traits;

use App\Models\NhanVien;

trait ThuocNhanVien
{
    public function nhanVien()
    {
        return $this->belongsTo(NhanVien::class, 'id_nhan_vien', 'id');
    }
}
