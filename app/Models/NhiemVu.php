<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhiemVu extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'tochuc___nhiem_vu';
    protected $fillable = [
        'id_vi_tri',
        'ten_nhiem_vu',
    ];

    public function viTri()
    {
        return $this->belongsTo(Vitri::class, 'id_vi_tri', 'id');
    }

    public function moTaNhiemVu()
    {
        return $this->hasMany(MoTaNhiemVu::class, 'id_nhiem_vu', 'id');
    }

    public function history()
    {
        return $this->morphMany(LichSuThayDoi::class, 'loggable')->latest();
    }
}
