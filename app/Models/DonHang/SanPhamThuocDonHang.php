<?php

namespace App\Models\DonHang;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPhamThuocDonHang extends Model
{
    use HasFactory;

    protected $table = 'cms___san_pham_thuoc_don_hang';

    protected $fillable = [
        'id_don_hang',
        'id_san_pham',
        'gia_san_pham',
        'gia_ban',
        'so_luong',
        'ti_le_thuong',
        'so_tien_thuong',
        'da_cap_nhat',
        'chi_phi_phat_sinh',
        'so_tien_tinh_thuong',
        'gia_ban_khong_vat',
        'thue_vat',
        'ti_le_vat',
        'chiet_khau',
        'ti_le_chiet_khau'
    ];

    /**
     * don hang co san pham nay
    */
    public function donHang(){
        return $this->belongsTo(DonHang::class,'id_don_hang','id');
    }

    /**
     * san pham thuoc danh muc san pham nao
    */
    public function danhMucSanPham(){
        return $this->belongsTo(DanhMucSanPham::class,'id_san_pham','id');
    }

    public static function boot()
    {
        parent::boot();

        self::updating(function ($sanPham) {
            
            if($sanPham->isDirty('ti_le_thuong') || $sanPham->isDirty('gia_ban') || $sanPham->isDirty('chi_phi_phat_sinh')) {
                $sanPham->so_tien_thuong =  ($sanPham->ti_le_thuong/100)*($sanPham->so_tien_tinh_thuong);
                
            }
        });
        

       
    }


}
