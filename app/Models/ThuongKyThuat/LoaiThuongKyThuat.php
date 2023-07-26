<?php

namespace App\Models\ThuongKyThuat;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LoaiThuongKyThuat extends Model
{
    // use HasFactory;

    public $table = 'kt___loai_thuong_ky_thuat';

    public $timestamps = false;

    public $fillable = [
        'ma_loai',
        'ten_loai',
        'mo_ta'
    ];

    public function thuongKyThuatDonHangs() : HasMany
    {
        return $this->hasMany(ThuongKyThuatDonHang::class,'id_loai','id');
    }

    /**
     * check xem loai nay co thong tin thuong nao chua, chua thi co the xoa
     */
    public function coTheXoa() : bool
    {
        if($this->thuongKyThuatDonHangs->isNotEmpty()) {
            return false;
        }            
        return true;
    }

    /**
     * ds thuong cua nhom mastercam
     */
    public function scopeDsLoaiMastercam($query) {
        return $query->where([
            ['ma_loai','like','MASTERCAM_%']
        ]);
    }

    /**
     * ds thuong cua nhom mastercam
     */
    public function scopeDsLoaiKhacMastercam($query) {
        return $query->where([
            ['ma_loai','not like','MASTERCAM_%']
        ]);
    }
}
