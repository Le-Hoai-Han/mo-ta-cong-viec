<?php

namespace App\Models\Thuong;

use App\Models\DanhMucThangNam;
use App\Models\NhanVien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongMoMoi extends Model
{
    use HasFactory;
    protected $table= "tmm___thuong_mo_moi";
    protected $fillable = [
        'id_nhan_vien',
        'id_thang_nam',
        'so_tien_thuong_mo_moi'
    ];

    public function nhanVien(){
        return $this->belongsTo(NhanVien::class,'id_nhan_vien','id');
    }

    public function thangNam(){
        return $this->belongsTo(DanhMucThangNam::class,'id_thang_nam','id');
    }

   
}
