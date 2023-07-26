<?php

namespace App\Traits;

use App\Models\DanhMucThangNam;

trait CoThangNam
{
    public function thangNam()
    {
        return $this->belongsTo(DanhMucThangNam::class, 'id_thang_nam', 'id');
    }
}
