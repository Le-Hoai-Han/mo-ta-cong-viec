<?php

namespace App\Models\ThuongKyThuat;

// use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\DonHang\DonHang;
use App\Traits\ThuongKyThuat\ThuongCaiDatMastercamTrait;
use App\Traits\ThuongKyThuat\ThuongDaoTaoGeomagicTrait;
use App\Traits\ThuongKyThuat\ThuongDaoTaoMastercamTrait;
use App\Traits\ThuongKyThuat\ThuongLapDatTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ThuongKyThuatDonHang extends Model
{
    use ThuongLapDatTrait;
    use ThuongDaoTaoMastercamTrait;
    use ThuongCaiDatMastercamTrait;
    use ThuongDaoTaoGeomagicTrait;
    // use HasFactory;
    public $table = 'kt___thuong_ky_thuat_don_hang';

    public $fillable = [
        'id_loai',
        'id_don_hang',
        'so_tien_thuong',
        'mo_ta',
        'ngay_cap_nhat'
    ];

    CONST LOAI_LAP_DAT = 'LAP_DAT_THIET_BI';
    CONST LOAI_MASTERCAM_LC = 'MASTERCAM_LC';
    CONST LOAI_MASTERCAM_DAO_TAO = 'MASTERCAM_DAO_TAO';
    CONST LOAI_GEOMAGIC = ['GEOMAGIC_2T','GEOMAGIC_3T','GEOMAGIC_5T'];

    CONST MA_KH_MASTERCAM = 16086;

    public $timestamps = false;

    public function loaiThuongKyThuat() : BelongsTo
    {
        return $this->belongsTo(LoaiThuongKyThuat::class,'id_loai','id');
    }

    public function donHang() : BelongsTo
    {
        return $this->belongsTo(DonHang::class,'id_don_hang','id');
    }

    /**
     * lay ds thuong lap dat thiet bi hoac geomagic cho team AE
     */
    public function scopeLaThuongLapDatHoacGeomagic($query) {
        return $query->whereHas('loaiThuongKyThuat',function($query) {
            $query->where('ma_loai',self::LOAI_LAP_DAT);
            $query->orWhereIn('ma_loai',self::LOAI_GEOMAGIC);
        });
    } 
   
    /**
     * ds thuong Mastercam
     */
    public function scopeLaThuongMastercam($query) {
        return $query->whereHas('loaiThuongKyThuat',function($query) {
            $query->whereIn('ma_loai',[self::LOAI_MASTERCAM_LC,self::LOAI_MASTERCAM_DAO_TAO]);
        });
    } 

   
}
