<?php 
namespace App\Services\ThuongQuanLy;

use App\Models\ThuongQuanLy\ThuongSanPhamQuanLy;
use App\Traits\ThuongQuanLy\KhoiTaoThuongSanPhamTrait;
use App\Traits\ThuongQuanLy\SanPhamDuocTinhThuongTrait;
use App\Traits\ThuongQuanLy\TienThuongSanPhamDonHangTrait;
use Illuminate\Database\Eloquent\Collection;

class ThuongQuanLySanPhamService
{
    use KhoiTaoThuongSanPhamTrait;
    use TienThuongSanPhamDonHangTrait;
    use SanPhamDuocTinhThuongTrait;

    /**
     * cap nhat khoa thuong thoi gian
     */
    public function khoaThuong(ThuongSanPhamQuanLy $thuongSanPhamQuanLy) : void 
    {
        $thuongSanPhamQuanLy->da_khoa = ThuongSanPhamQuanLy::TT_DA_KHOA;
        $thuongSanPhamQuanLy->saveQuietly();
        
    }

    /**
     * cap nhat mo khoa thuong
     */
    public function moKhoaThuong(ThuongSanPhamQuanLy $thuongSanPhamQuanLy) : void 
    {
        $thuongSanPhamQuanLy->da_khoa = ThuongSanPhamQuanLy::TT_KO_KHOA;
        $thuongSanPhamQuanLy->saveQuietly();
    }

    /**
     * lay danh sach san pham duoc tinh thuong theo thuong quan ly
     */
    public function getDanhSachSanPhamDuocTinhThuongTheoModel(ThuongSanPhamQuanLy $thuong) : Collection
    {
        $dsDonHangThuongID = $thuong->danhSachDonHangThuong->pluck('id')->toArray();
        $dsSanPhamQuanLyTheoNhomID = $this->getDsSanPhamQuanLyTheoNhomNhanVien($thuong->nhomNhanVien());

        return $this->getDanhSachSanPhamDuocThuong($dsDonHangThuongID, $dsSanPhamQuanLyTheoNhomID);

    }
    
}