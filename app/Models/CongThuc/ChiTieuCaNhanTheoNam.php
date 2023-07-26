<?php

namespace App\Models\CongThuc;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Thuong\ThuongNamNhanVien;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChiTieuCaNhanTheoNam extends Model
{
    // use HasFactory;

    protected $table = 'cms___chi_tieu_ca_nhan_theo_nam';

    public $fillable = [
        'id_thuong_nam',
        'id_chi_tieu',
        'muc_tieu',
        'ket_qua',
        'ti_le_dat_duoc',
        'id_nguoi_cap_nhat'
    ];

    public function thuongNam() : BelongsTo
    {
        return $this->belongsTo(ThuongNamNhanVien::class,'id_thuong_nam','id');
    }

    public function chiTieu() : BelongsTo
    {
        return $this->belongsTo(DanhSachChiTieu::class,'id_chi_tieu','id');
    }

   
}
