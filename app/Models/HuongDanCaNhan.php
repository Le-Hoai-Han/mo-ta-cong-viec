<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HuongDanCaNhan extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $table = 'tochuc___huong_dan_ca_nhans';
    protected $fillable = [
        'id_vi_tri',
        'ten_huong_dan',
    ];

    protected static function booted()
    {
        parent::boot();
        static::creating(function ($viTri) {
        });

        static::updating(function ($viTri) {
            ///
        });
    }

    public function viTri()
    {
        return $this->belongsTo(Vitri::class, 'id_vi_tri', 'id');
    }

    public function moTaHuongDan()
    {
        return $this->hasMany(MoTaHuongDanCaNhan::class, 'id_huong_dan', 'id');
    }
}
