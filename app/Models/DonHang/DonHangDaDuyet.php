<?php

namespace App\Models\DonHang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class DonHangDaDuyet extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table="sp___don_hang_da_duyet";
    protected $fillable=[
        'id_don_hang',
        'id_khach_hang',
        'email_nguoi_lien_he',
        'trang_thai'
    ];
    protected $primaryKey= "id_don_hang";

    /**
     * don hang da duyet
     */
    public function donHang() : BelongsTo
    {
        return $this->belongsTo(DonHang::class,'id_don_hang','id');
    }

    const TT_THANH_CONG = 1;
    const TT_LOI_NGUOI_TAO_DON = 2;
    const TT_LOI_NGUOI_LIEN_HE = 3;
    const TT_LOI_TT_KH = 5;

}
