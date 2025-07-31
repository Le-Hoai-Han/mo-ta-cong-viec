<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MoTaNhiemVu extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'tochuc___mo_ta_nhiem_vu';
    protected $fillable = [
        'id_nhiem_vu',
        'chi_tiet',
        'ket_qua',
        'mo_ta',
    ];

    public function nhiemVu()
    {
        return $this->hasOne(NhiemVu::class, 'id', 'id_nhiem_vu');
    }

    public function history()
    {
        return $this->morphMany(LichSuThayDoi::class, 'loggable')->latest();
    }
}
