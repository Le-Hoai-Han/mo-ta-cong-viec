<?php

namespace App\Models\Thuong;

use App\Models\CongThuc\CongThucTinh;
use App\Traits\ThuocHangMuc;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThuongNhanVienTheoHangMuc extends Model
{
    use HasFactory;
    use ThuocHangMuc;

    protected $table = "cms___thuong_nhan_vien_theo_hang_muc";
    public $timestamps  = false;
    protected $fillable = [
        'id_thuong_nhan_vien',
        'id_hang_muc',
        'muc_thuong',
        'so_tien_thuong'
    ];

    public function thuongNhanVien()
    {
        return $this->belongsTo(ThuongNhanVien::class, 'id_thuong_nhan_vien', 'id');
    }


    protected static function booted()
    {
        static::creating(function ($thuongHangMuc) {
            $thuongHangMuc->muc_thuong = 0;
            $thuongHangMuc->so_tien_thuong = 0;
        });

        static::updated(function($thuongHangMuc){
            $thuongHangMuc->thuongNhanVien->tinhTongTienThuong();
        });
    }

    public function tinhTienThuongHangMuc()
    {
        $ketQuaTinhThuong = KetQuaTinhThuong::where([
            'id_hang_muc' => $this->id_hang_muc,
            'id_thuong_nhan_vien' => $this->id_thuong_nhan_vien,
        ])->whereRelation('congThuc', 'la_cong_thuc_chinh', CongThucTinh::LA_CONG_THUC_CHINH)
            ->first();
        // dd($ketQuaTinhThuong);
        if ($ketQuaTinhThuong !== null) {
            $ketQuaTinhThuong->tinhKetQua();
            // dd($ketQuaTinhThuong);
            $ketQuaTinhThuong->refresh();
            $thuongHangMuc = ThuongNhanVienTheoHangMuc::find($this->id);
            $thuongHangMuc->update([
                'muc_thuong' => 100,
                'so_tien_thuong' => $ketQuaTinhThuong->ket_qua_tinh
            ]);
        }
        // return $ketQuaTinhThuong;
    }
}
