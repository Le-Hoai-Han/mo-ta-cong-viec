<?php

namespace App\Models\ThuongQuanLy;

use App\Models\DonHang\DonHang;
use App\Models\NhanVien;
use App\Models\NhanVien\NhomNhanVien;
use App\Traits\ThuocNhanVien;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class ThuongSanPhamQuanLy extends Model
{
    use HasFactory;
    use ThuocNhanVien;

    CONST TT_DA_KHOA = 1;
    CONST TT_KO_KHOA = 0;
    

    public $table = 'pm___thuong_san_pham_quan_ly';

    public $fillable = [
        'thang',
        'nam',
        'id_nhan_vien',
        'so_tien_thuong'
    ];

    /**
     * lay danh sach don hang tinh thuong 
     */
    public function danhSachDonHangThuong() : BelongsToMany
    {
        return $this->belongsToMany(DonHang::class,'pm___don_hang_thuong_san_pham_quan_ly','id_thuong_san_pham_quan_ly','id_don_hang');
    }

    /**
     * thong tin nhom nhan vien thuoc thuong nay
     */
    public function nhomNhanVien() : ?NhomNhanVien
    {
        if($this->nhanVien->id_nhom_nhan_vien) {
            return $this->nhanVien->nhomNhanVien;
        } 
        return null;
    }

    /**
     * ti le thuong theo nhom
     */
    private $_dsTiLeThuong = [
        'SUPERVISOR_PRODUCTION' => 1/100,
        'SUPERVISOR_CNC' => 1/100
    ];

    /**
     * lay ti le thuong theo nhom
     */
    public function tiLeTinhThuong($maNhom) {
        if(isset($this->_dsTiLeThuong[$maNhom])) {
            return $this->_dsTiLeThuong[$maNhom];
        }
        return 0;
        
    }

    /**
     * ti le tinh thuong theo nhom hien tai cua nhan vien
     */
    public function tiLeTinhThuongCuaNhanVien() {
        $nhomNhanVien = $this->nhomNhanVien();
        return $this->tiLeTinhThuong($nhomNhanVien->ma_nhom);
    }

    /**
     * check trang thai thuong
     */
    public function daKhoa() : bool 
    {
        return (bool)$this->da_khoa;
    }

    /**
     * label trang thai thuong
     */
    public function labelTrangThai() : string 
    {
        if($this->daKhoa()) {
            return "<span class='badge bg-gradient-success'>Đã phát thưởng</span>";
        }
        return "<span class='badge bg-gradient-dark'>Chưa phát thưởng</span>";
    }

    protected static function booted() {
        parent::booted();
        static::deleting(function ($thuong) {
            $thuong->danhSachDonHangThuong()->detach();
        });
    }


}
