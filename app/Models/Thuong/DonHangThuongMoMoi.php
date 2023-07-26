<?php

namespace App\Models\Thuong;

use App\Models\DanhMucThangNam;
use App\Models\DonHang\DonHang;
use App\Models\KhachHang;
use App\Models\NhanVien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHangThuongMoMoi extends Model
{
    use HasFactory;
    protected $table="tmm___don_hang_thuong_mo_moi";

    protected $fillable=[
        'id_khach_hang_don_hang',
        'id_don_hang',
        'id_thang_nam',
        'so_tien_thuong',
        'da_nhan_thuong',
        'ngay_thanh_toan_du',
        'id_nhan_vien'
    ];

    public function TMMDonHangKhachHang(){
        return $this->hasOne(TMMDonHangKhachHang::class,'id','id_khach_hang_don_hang');
    }

    public function donHang(){
        return $this->hasOne(DonHang::class,'id','id_don_hang');
    }

    public function nhanVien(){
        return $this->belongsTo(NhanVien::class,'id_nhan_vien','id');
    }

    public function thangNam(){
        return $this->belongsTo(DanhMucThangNam::class,'id_thang_nam','id');
    }


}
