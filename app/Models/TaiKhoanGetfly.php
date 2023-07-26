<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaiKhoanGetfly extends Model
{
    public $table = "tai_khoan_getfly";

    public function dsNhanVien() : HasMany
    {
        return $this->hasMany(NhanVien::class,'getfly_id','id');
    }
}
