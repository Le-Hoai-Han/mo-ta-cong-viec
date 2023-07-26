<?php 
namespace App\Traits\ThuongQuanLy;

use App\Models\DonHang\DanhMucSanPham;
use App\Models\DonHang\LoaiSanPham;
use App\Models\NhanVien\NhomNhanVien;

trait LoaiSanPhamQuanLyTrait
{
    /**
     * ds loai san pham quan ly theo nhom (bao gom danh muc con)
     */
    public function dsLoaiSanPhamQuanLyTheoNhomNhanVien(NhomNhanVien $nhomNhanVien) : array
    {
        $dsLoaiSanPham = $nhomNhanVien->loaiSanPham;
        $dsLoaiSanPhamQuanLy = $dsLoaiSanPham->pluck('id')->toArray();
        foreach($dsLoaiSanPham as $loaiSanPham) {
            $dsLoaiSanPhamQuanLy = array_merge($dsLoaiSanPhamQuanLy,$this->_getLoaiSanPhamCon($loaiSanPham));
        }
        return $dsLoaiSanPhamQuanLy;
    }

    /**
     * lay loai san pham con cua 1 loai san pham
     */
    private function _getLoaiSanPhamCon(LoaiSanPham $loaiSanPhamCha) : array
    {
        $dsLoaiSanPhamCon = [];
        
        if($loaiSanPhamCha->children->isNotEmpty()) {
            $dsLoaiSanPhamCon = $loaiSanPhamCha->children->pluck('id')->toArray();
            foreach($loaiSanPhamCha->children as $loaiSanPhamCon) {
                $dsLoaiSanPhamCon = array_merge($dsLoaiSanPhamCon,$this->_getLoaiSanPhamCon($loaiSanPhamCon));
            }
        }
        
        return $dsLoaiSanPhamCon;
    }

    /**
     * danh sach san pham theo ds loai
     */
    public function getDsSanPhamTheoDsLoai(array $dsLoai) : array 
    {
        return DanhMucSanPham::whereIn('id_loai_san_pham',$dsLoai)->get()->pluck('id')->toArray();
    }

    /**
     * danh sach san pham quan ly theo nhom nhan vien
     */
    public function getDsSanPhamQuanLyTheoNhomNhanVien(NhomNhanVien $nhomNhanVien) : array 
    {
        $dsLoaiSanPhamQuanLy = $this->dsLoaiSanPhamQuanLyTheoNhomNhanVien($nhomNhanVien);
        return $this->getDsSanPhamTheoDsLoai($dsLoaiSanPhamQuanLy);
    }
}