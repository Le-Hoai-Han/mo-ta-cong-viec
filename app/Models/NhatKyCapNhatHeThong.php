<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhatKyCapNhatHeThong extends Model
{
    use HasFactory;
    protected $table = "cms___nhat_ky_cap_nhat_he_thong";

    protected $fillable = [
        'id_nguoi_thay_doi',
        'ten_model_thay_doi',
        'id_model_thay_doi',
        'noi_dung_cu',
        'noi_dung_moi'
    ];

    /**
        * Get the model that the image belongs to.
    */
    public function thongTinCapNhat()
    {
        return $this->morphTo(__FUNCTION__, 'ten_model_thay_doi', 'id_model_thay_doi');
    }

    public function nguoiThayDoi(){
        return $this->hasMany(NhanVien::class,'id','id_nguoi_thay_doi');
    }
}
