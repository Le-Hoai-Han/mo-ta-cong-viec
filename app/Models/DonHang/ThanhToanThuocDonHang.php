<?php

namespace App\Models\DonHang;

use App\Jobs\KiemTraTinhThuongDonHangJob;
use App\Traits\GetflyApi;
use App\Traits\TinhThuongDonHang;
use Illuminate\Database\Eloquent\Model;

class ThanhToanThuocDonHang extends Model
{
    use TinhThuongDonHang;
    use GetflyApi;
    protected $table = 'cms___thanh_toan_thuoc_don_hang';

    protected $fillable = [
        'id_don_hang',
        'so_tien_thanh_toan',
        'ngay_thanh_toan',
        'da_cap_nhat'
    ];

    /**
     * don hang co thanh toan nay
     */
    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'id_don_hang', 'id');
    }

    /**
     * don hang duoc tinh thuong de tinh ngan sach thuong
     */
    public function donHangDuocTinhThuong()
    {
        return $this->belongsTo(DonHang::class, 'id_don_hang', 'id')->where(['duoc_tinh_thuong' => DonHang::DUOC_TINH_THUONG]);
    }

    protected static function booted()
    {
        static::creating(function($thanhToan) {
            $thanhToan->da_cap_nhat = 0;
        });

        static::created(function ($thanhToan) {
            //  Event kiểm tra tính thưởng đơn hàng
            KiemTraTinhThuongDonHangJob::dispatch($thanhToan->donHang)->delay(now()->addMinutes(1));

            // $thanhToan->_kiemTraTinhThuongDonHang($thanhToan->donHang);
        });

        static::updated(function ($thanhToan) {
            // $thanhToan->_kiemTraTinhThuongDonHang($thanhToan->donHang);
            KiemTraTinhThuongDonHangJob::dispatch($thanhToan->donHang)->delay(now()->addMinutes(1));

            
        });

        static::deleted(function($thanhToan) {
            // dd($thanhToan->donHang->_kiemTra);
            // $thanhToan->_kiemTraTinhThuongDonHang($thanhToan->donHang);
            KiemTraTinhThuongDonHangJob::dispatch($thanhToan->donHang)->delay(now()->addMinutes(1));

        });
    }
}
