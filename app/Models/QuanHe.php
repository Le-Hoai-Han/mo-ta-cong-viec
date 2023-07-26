<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuanHe extends Model
{
    use HasFactory;
    protected $table ='quan_he_trong_cong_viec';
    protected $fillable = [
        'id_vi_tri',
        'noi_dung',
        'loai',
    ];

    public function viTri(){
        return $this->hasOne(Vitri::class,'id','id_vi_tri');
    }
}
