<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ASK extends Model
{
    use HasFactory;
    protected $table ='tochuc___ask';
    protected $fillable = [
        'id_vi_tri',
        'noi_dung',
        'loai',
    ];

    const THAI_DO = 0;
    const KY_NANG = 1;
    const KIEN_THUC = 2;

    public function viTri(){
        return $this->hasOne(Vitri::class,'id','id_vi_tri');
    }
}
