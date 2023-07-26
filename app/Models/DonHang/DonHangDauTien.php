<?php

namespace App\Models\DonHang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHangDauTien extends Model
{
    use HasFactory;
    protected $table = "tmm___don_hang_dau_tien";
    protected $fillable = [
        'id_don_hang',
        'id_don_hang_dau_tien',
    ];

    public function  donHang(){
        return $this->belongsTo(DonHang::class,'id_don_hang_dau_tien','id');
    }
}
