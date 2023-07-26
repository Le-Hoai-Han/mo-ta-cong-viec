<?php

namespace App\Traits;

use App\Models\CongThuc\CongThucTinh;

trait ThuocCongThuc
{
    public function congThuc()
    {
        return $this->belongsTo(CongThucTinh::class, 'id_cong_thuc', 'id');
    }
}
