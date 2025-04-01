<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanHe extends Model
{
    use HasFactory;
    protected $table ='tochuc___quan_he';
    protected $fillable = [
        'id_vi_tri',
        'noi_dung',
        'loai',
    ];

    const BEN_TRONG = 0;
    const BEN_NGOAI = 1;

    public function viTri(){
        return $this->hasOne(Vitri::class,'id','id_vi_tri');
    }
}
