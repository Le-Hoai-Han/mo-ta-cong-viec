<?php

namespace App\Models\ThuongKyThuat;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\DonHang\DanhMucSanPham;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SoTienThuongKyThuat extends Model
{
  
    
    public $table = 'kt___so_tien_thuong_ky_thuat';
    
    public $fillable = [
        'id_nhom_nhan_vien',
        'tien_thuong_co_ban',
        'tien_thuong_vuot_muc',
        'so_luong_gioi_han',
        'dang_su_dung',
        'phien_ban',
        'id_phien_ban_cu',
        'mo_ta'
    ];

    CONST TT_DANG_SU_DUNG = 1;
    CONST TT_NGUNG_SU_DUNG = 0;

    CONST MOTA_MASTERCAM = "MASTERCAM";

    

    public function phienBanCu() : BelongsTo
    {
        return $this->belongsTo(SoTienThuongKyThuat::class,'id_phien_ban_cu','id');
    }

    public function phienBanMoi() : HasOne 
    {
        return $this->hasOne(SoTienThuongKyThuat::class,'id_phien_ban_cu','id');
    }

    /**
     * so tien thuong ky thuat theo san pham relation
     */
    public function tienThuongTheoSanPhams() : BelongsToMany
    {
        return $this->belongsToMany(DanhMucSanPham::class,'kt___so_tien_thuong_ky_thuat_theo_san_pham','id_so_tien_thuong','id_san_pham');
    }


    static public function booted() 
    {
        parent::booted();
        self::saved(function($soTienThuongKyThuat){
            if($soTienThuongKyThuat->id_phien_ban_cu != "") {
                $phienBanCu = $soTienThuongKyThuat->phienBanCu;
                $phienBanCu->dang_su_dung = self::TT_NGUNG_SU_DUNG;
                $phienBanCu->saveQuietly();

            }
        });
    }

    /**
     * ds loai mastercam
     */
    public function scopeDsMucThuongMastercam($query) {
        return $query->where([[
            'mo_ta','like','MASTERCAM%'
        ]]);
    }

    /**
     * ds loai khác mastercam
     */
    public function scopeDsMucThuongKhacMastercam($query) {
        return $query->where([[
            'mo_ta','not like','MASTERCAM%'
        ]]);
    }

    /**
     * ds so tien thuong dang su dung
     */
    public function scopeDangSuDung($query) {
        return $query->where('dang_su_dung',self::TT_DANG_SU_DUNG);
    }

    
    /**
     * link view 
     */
    public function linkView($label="mo_ta") {
        $route = route('thuong-ky-thuat.so-tien-thuong.show',$this);
        return "<a href='".$route."' class='text-primary font-bold' title='Xem danh sách sản phẩm thuộc nhóm'>".$this->$label."</a>";
    }
}
