<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThamQuyen extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $table = 'tochuc___tham_quyen';
    protected $fillable = [
        'id_vi_tri',
        'noi_dung',
        'loai',
    ];

    CONST DE_XUAT = 1;
    CONST RA_QUYET_DINH = 2;

    public function viTri(){
        return $this->hasOne(Vitri::class,'id','id_vi_tri');
    }

    public function history()
    {
        return $this->morphMany(LichSuThayDoi::class, 'loggable')->latest();
    }
}
