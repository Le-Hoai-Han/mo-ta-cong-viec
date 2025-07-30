<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoTaHuongDanCaNhan extends Model
{
    use HasFactory;
    protected $table = 'tochuc___mo_ta_huong_dan_ca_nhans';
    protected $fillable = [
        'id_huong_dan',
        'chi_tiet',
        'ket_qua',
        'mo_ta',
    ];

    public function huongDan()
    {
        return $this->hasOne(NhiemVu::class, 'id', 'id_huong_dan');
    }
}
