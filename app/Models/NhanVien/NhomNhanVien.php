<?php

namespace App\Models\NhanVien;

use App\Models\CongThuc\CongThucTinh;
use App\Models\CongThuc\DanhSachChiTieu;
use App\Models\CongThuc\DanhSachHangMucThuong;
use App\Models\DonHang\LoaiSanPham;
use App\Models\NhanVien;
use App\Models\ThuongKyThuat\LoaiSanPhamQuanLy;
use App\Models\ThuongQuanLy\ThuongSanPhamQuanLy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class NhomNhanVien extends Model
{
    // use HasFactory;
    protected $table = 'cms___nhom_nhan_vien';

    public $fillable = [
        'ma_nhom',
        'ten_nhom',
        'id_quan_ly'
    ];

    public $timestamps = false;

    /**
     * Lấy danh sách nhân viên thuộc nhóm
     */
    public function nhanVienThuocNhom() : HasMany
    {
        return $this->hasMany(NhanVien::class,'id_nhom_nhan_vien','id');
    }

    /**
     * Lấy danh sách chỉ tiêu thuộc nhóm
     */
    public function chiTieuThuocNhom() : HasMany
    {
        return $this->hasMany(DanhSachChiTieu::class,'id_nhom_nhan_vien','id');
    }

    /**
     * Lấy danh sách công thức thuộc nhóm
     */
    public function congThucThuocNhom() : HasMany 
    {
        return $this->hasMany(CongThucTinh::class,'id_nhom_nhan_vien','id');
    }

    /**
     * Lấy danh sách hạng mục thuộc nhóm
     */
    public function hangMucThuocNhom() : HasMany 
    {
        return $this->hasMany(DanhSachHangMucThuong::class,'id_nhom_nhan_vien','id');
    }

    // Lấy tỉ lệ thưởng thuộc nhóm
    public function tiLeThuongThuocNhom()
    {
        return $this->belongsToMany(LoaiSanPham::class,'cms___ti_le_thuong_theo_nhom','id_nhom_nv','id_loai_sp');
    }

    /**
     * loai san pham quan ly
     */
    public function loaiSanPhamQuanLy() : HasMany
    {
        return $this->hasMany(LoaiSanPhamQuanLy::class,'id_nhom_nhan_vien');
    }

     /**
     * loai san pham quan ly
     */
    public function loaiSanPham() : BelongsToMany
    {
        return $this->belongsToMany(LoaiSanPham::class,'kt___loai_san_pham_quan_ly','id_nhom_nhan_vien','id_loai_san_pham');
    }

    /**
     * nhân viên quản lý
     */
    public function quanLy() : BelongsTo
    {
        return $this->belongsTo(NhanVien::class,'id_quan_ly','id');
    }

    /**
     * check xem nhom co quan ly hay khong
     */
    public function coQuanLy() : bool 
    {
        return (bool) $this->id_quan_ly;
    }

    /**
     * thong tin thuong san pham quan ly
     */
    public function thuongSanPhamQuanLy() : HasManyThrough
    {
        return $this->hasManyThrough(ThuongSanPhamQuanLy::class,NhanVien::class,'id_nhom_nhan_vien','id_nhan_vien');
    }

    

}
