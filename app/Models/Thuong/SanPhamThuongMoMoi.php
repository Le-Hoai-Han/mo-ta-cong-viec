<?php

namespace App\Models\Thuong;

use App\Models\DonHang\DanhMucSanPham;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamThuongMoMoi extends Model
{
    use HasFactory;
    protected $table='tmm___san_pham_thuong_mo_moi';
    protected $fillable=[
        'id_don_hang',
        'ti_le_thuong',
        'so_luong',
        'gia_san_pham',
        'id_danh_muc_san_pham'
    ];

    public function danhMucsanPham(){
        return $this->hasOne(DanhMucSanPham::class,'id','id_danh_muc_san_pham');
    }

    public function donHang(){
        return $this->hasOne(DonHang::class,'id','id_don_hang');
    }

}
