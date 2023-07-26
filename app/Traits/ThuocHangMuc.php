<?php

namespace App\Traits;

use App\Models\CongThuc\DanhSachHangMucThuong;
use App\Models\NhanVien;

trait ThuocHangMuc
{
    public function hangMuc()
    {
        return $this->belongsTo(DanhSachHangMucThuong::class, 'id_hang_muc', 'id');
    }
}
