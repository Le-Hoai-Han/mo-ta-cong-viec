<?php

namespace App\Models\Thuong;

use App\Models\DonHang\LoaiSanPham;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TiLeThuongMoMoi extends Model
{
    use HasFactory;
    protected $table="tmm___ti_le_thuong_mo_moi";
    protected $fillable=[
        'id_loai_san_pham',
        'ti_le_thuong',
        'mo_ta',
    ];

    const TT_DANG_SU_DUNG=1;
    const TT_PHIEN_BAN_CU=0;

    public $dsTrangThai = [
        self::TT_DANG_SU_DUNG => 'Đang sử dụng',
        self::TT_PHIEN_BAN_CU => 'Phiên bản củ'
    ];


    public function loaiSanPham(){
        return $this->belongsTo(LoaiSanPham::class,'id_loai_san_pham','id');
    }
}
