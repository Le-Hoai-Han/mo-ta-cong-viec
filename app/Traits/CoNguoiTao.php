<?php

namespace App\Traits;

use App\Models\User;

trait CoNguoiTao
{
    public function nguoiTao()
    {
        return $this->belongsTo(User::class, 'id_nguoi_tao', 'id');
    }
}
