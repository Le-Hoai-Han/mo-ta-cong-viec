<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TieuChuanTuyenChon extends Model
{
    use HasFactory;
    protected $table = 'tieu_chuan_tuyen_chon';
    protected $fillable = [
        'id_vi_tri',
        'gioi_tinh',
        'tuoi',
        'hoc_van',
        'chuyen_mon',
        'vi_tinh',
        'anh_ngu',
        'kinh_nghiem',
        'ky_nang',
        'to_chat',
        'ngoai_hinh',
        'suc_khoe',
        'ho_khau',
        'uu_tien',
    ];

    public function viTri(){
        return $this->belongsTo(Vitri::class,'id_vi_tri','id');
    }
}
