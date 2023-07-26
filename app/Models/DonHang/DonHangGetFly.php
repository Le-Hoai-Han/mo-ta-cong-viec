<?php

namespace App\Models\DonHang;

use Illuminate\Database\Eloquent\Model;
use App\Traits\GetflyApi;
use App\Observers\DonHangGetflyObserver;

class DonHangGetFly extends DonHang
{
    use GetflyApi;
    public $trang_thai_getfly = "";

    protected $fillable = [
        'ma_don_hang',
        'ten_nguoi_tao',
        'id_nhan_vien',
        'doanh_so',
        'doanh_thu',
        'da_thanh_toan',
        'ngay_tao_don',
        'ngay_bat_dau_tinh_thoi_han',
        'ngay_ket_thuc_tinh_thuong',
        'ngay_nghiem_thu',
        'duoc_tinh_thuong',
        'da_cap_nhat',
        'trang_thai',
        'tien_thuong_don_hang',
        'la_nguon_marketing',
        'la_don_hang_thanh_ly',
        'chi_phi_phat_sinh',
        'trang_thai_getfly',
        'dat_lai',
        'id_khach_hang',
        'phi_van_chuyen_cua_don_hang'
    ];

    public function statusGetflyToThis(int $getflyStatus) : int 
    {
        switch($getflyStatus){
            case 2:
                $status = DonHangGetfly::TT_DUYET;
                break;
            case 4:
                $status= DonHangGetfly::TT_DUYET;
                break;
            case 5:
                $status = DonHangGetfly::TT_HUY;
                break;
            default:
                $status = DonHangGetfly::TT_MOI;
                break;
        }
        return $status;
    }

    public function setTrangThaiGetflyAttribute($value) {
        $this->trang_thai_getfly = $value;
        $this->trang_thai = $this->statusGetflyToThis($this->trang_thai_getfly);
    }
}
