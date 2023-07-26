<?php 
namespace App\Traits\ThuongQuanLy;

use App\Models\ThuongQuanLy\ThuongSanPhamQuanLy;

trait KhoiTaoThuongSanPhamTrait
{
    /**
     * khoi tao thong tin thuong san pham quan ly
     */
    public function khoiTaoThongTinThuong(int $thang, int $nam, int $idNhanVien) : ThuongSanPhamQuanLy
    {
        $thuong = ThuongSanPhamQuanLy::firstOrCreate([
            'thang' => $thang,
            'nam' => $nam,
            'id_nhan_vien' => $idNhanVien
        ],[
            'so_tien_thuong' => 0
        ]);
        return $thuong;
    }   
}
