<?php

namespace App\Models\Thuong;

use App\Models\DonHang\DonHang;
use App\Models\KhachHang;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMMDonHangKhachHang extends Model
{
    use HasFactory;
    protected $table ="tmm___don_hang_khach_hang";
    protected $fillable=[
        'id',
        'id_khach_hang',
        'id_don_hang_dau_tien',
        'ngay_bat_dau',
        'ngay_ket_thuc',
        'id_nhan_vien',
        'trang_thai'
    ];

    CONST TT_DUOC_TINH_THUONG = 1;
    CONST TT_KHONG_TINH_THUONG = 0;

     public static function boot()
     {
        parent::boot();

        self::creating(function($donHangThuongMoMoi){
            $donHangThuongMoMoi->ngay_ket_thuc =date('Y-m-d',strtotime($donHangThuongMoMoi->ngay_bat_dau .' +6 month'));
        });

        self::updating(function($donHangThuongMoMoi){
            $donHangThuongMoMoi->ngay_ket_thuc =date('Y-m-d',strtotime($donHangThuongMoMoi->ngay_bat_dau .' +6 month'));
        });
     }

     public function donHangThuongMoMoi(){
        return $this->hasMany(DonHangThuongMoMoi::class,'id_khach_hang_don_hang','id');
     }

     public function sanPhamThuocMoMoi(){
        return $this->hasMany(SanPhamThuocMoMoi::class,'id_khach_hang_don_hang','id');
     }
     public function khachHang(){
        return $this->hasOne(KhachHang::class,'id','id_khach_hang');
    }

    public function donHangDauTien(){
        return $this->hasOne(DonHang::class,'id','id_don_hang_dau_tien');
    }
}
