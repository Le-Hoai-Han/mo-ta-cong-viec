<?php

namespace App\Models\CongThuc;

use App\Interfaces\CheckDeleteInterface;
use App\Models\KetQuaTinhThuong;
use App\Models\Thuong\ThuongNhanVien;
use App\Models\Thuong\ThuongNhanVienTheoHangMuc;
use App\Traits\ThuocNhomNhanVien;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DanhSachHangMucThuong extends Model implements CheckDeleteInterface
{
    // use HasFactory;
    use ThuocNhomNhanVien;
    protected $table = 'cms___danh_sach_hang_muc_thuong';

    protected $fillable = [
        'ten_hang_muc',
        'mo_ta',
        'id_nhom_nhan_vien'
    ];

    public function ketQuaTinhThuong()
    {
        return $this->hasMany(KetQuaTinhThuong::class, 'id_hang_muc', 'id');
    }

    public function thuongNhanVienTheoHangMuc()
    {
        return $this->hasMany(ThuongNhanVienTheoHangMuc::class, 'id_hang_muc', 'id');
    }

    public function thuongNhanVien()
    {
        return $this->belongsToMany(ThuongNhanVien::class, 'cms___thuong_nhan_vien_theo_hang_muc', 'id_hang_muc', 'id_thuong_nhan_vien');
    }

    public function checkDelete()
    {
        if ($this->ketQuaTinhThuong->isNotEmpty()) {
            $check = false;
        }
        if ($this->thuongNhanVienTheoHangMuc->isNotEmpty()) {
            return false;
        }

        return true;
    }
}
