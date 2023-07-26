<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiLeThuongTheoNhomSP extends Model
{
    use HasFactory;
    protected $table="cms___ti_le_thuong_theo_nhom";
    protected $fillable=[
        'id_nhom_nv',
        'id_loai_sp',
        'ti_le_thuong'
    ];
    public $timestamps = false;
}
