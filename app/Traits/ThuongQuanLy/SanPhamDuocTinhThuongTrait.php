<?php 
namespace App\Traits\ThuongQuanLy;

use App\Models\DonHang\SanPhamThuocDonHang;
use Illuminate\Database\Eloquent\Collection;

trait SanPhamDuocTinhThuongTrait
{
    /**
     * lay san pham duoc thuong dua vao don hang duoc tinh thuong va danh sach san pham quan ly
     */
    public function getDanhSachSanPhamDuocThuong(array $dsDonHangThuongID, array $dsSanPhamQuanLyID) : Collection
    {
        return SanPhamThuocDonHang::whereIn('id_don_hang',$dsDonHangThuongID)
                            ->whereIn('id_san_pham',$dsSanPhamQuanLyID)
                            ->get();
        
    }
}