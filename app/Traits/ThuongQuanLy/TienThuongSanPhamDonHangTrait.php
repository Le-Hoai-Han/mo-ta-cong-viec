<?php 
namespace App\Traits\ThuongQuanLy;

use App\Models\DonHang\DonHang;
use App\Models\DonHang\SanPhamThuocDonHang;
use App\Models\ThuongQuanLy\ThuongSanPhamQuanLy;
use App\Traits\DonHang\DanhSachThanhToan;
use Illuminate\Database\Eloquent\Collection;

trait TienThuongSanPhamDonHangTrait
{
    use LoaiSanPhamQuanLyTrait;
    use DanhSachThanhToan;

    /**
     * lay so tien thuong moi nhat de hien thi
     */
    // public function laySoTienDuocThuongMoiNhat(ThuongSanPhamQuanLy $thuong) : float 
    // {
    //     $this->tinhTienThuongSanPhamQuanLy($thuong);
    //     $thuong->refresh();
    //     return $thuong->so_tien_thuong;

    // }

    /**
     * cap nhat thong tin thuong san pham quan ly
     * bao gom don hang va tinh tien
     */
    public function capNhatThuongSanPhamQuanLy(ThuongSanPhamQuanLy $thuong) : void 
    {
        if(!$thuong->daKhoa())
        {
            $nhomNhanVien = $thuong->nhomNhanVien();
            $dsSanPhamQuanLy = $this->getDsSanPhamQuanLyTheoNhomNhanVien($nhomNhanVien);
            
            $this->_capNhatDonHangThuongSanPhamTheoDanhSach($thuong, $dsSanPhamQuanLy);
            $this->_capNhatSoTienThuongSanPhamTheoDanhSach($thuong, $dsSanPhamQuanLy);
            $thuong->refresh();
        }
    }



    /**
     * tinh tien thuong san pham quan ly
     * khong cap nhat don hang co san
     */
    public function capNhatSoTienThuongSanPhamQuanLy(ThuongSanPhamQuanLy $thuong) : void 
    {
        if(!$thuong->daKhoa())
        {
            $nhomNhanVien = $thuong->nhomNhanVien();
            $dsSanPhamQuanLy = $this->getDsSanPhamQuanLyTheoNhomNhanVien($nhomNhanVien);

            $this->_capNhatDonHangThuongSanPhamTheoDanhSach($thuong, $dsSanPhamQuanLy, $nhomNhanVien->ma_nhom);
        }
    }

    private function _capNhatSoTienThuongSanPhamTheoDanhSach(ThuongSanPhamQuanLy $thuong,  array $dsSanPhamQuanLy) : void 
    {
        $thuong->so_tien_thuong = $this->_tinhTienThuongSanPham($thuong, $dsSanPhamQuanLy);
        $thuong->saveQuietly(); 
    }

    /**
     * tinh tien thuong san pham theo loai va nhom nhan vien
     */
    private function _tinhTienThuongSanPham(ThuongSanPhamQuanLy $thuong,  array $dsSanPhamQuanLy) : float {
        $dsDonHangDuocThuong = $thuong->danhSachDonHangThuong->pluck('id')->toArray();
        $dsSanPhamDuocThuong = $this->_dsSanPhamDuocTinhThuong($dsDonHangDuocThuong, $dsSanPhamQuanLy);
        $tongSoTienTinhThuong = $dsSanPhamDuocThuong->sum('so_tien_tinh_thuong');
        return $thuong->tiLeTinhThuongCuaNhanVien() * $tongSoTienTinhThuong;       
    }


    

    /**
     * ds san pham duoc tinh thuong thuoc don hang
     */
    private function _dsSanPhamDuocTinhThuong(array $dsDonHang, array $dsSanPhamQuanLy) : ?Collection
    {
        $dsSanPham = SanPhamThuocDonHang::whereIn('id_don_hang',$dsDonHang)
                    ->whereIn('id_san_pham',$dsSanPhamQuanLy)
                    ->get();
        return $dsSanPham;
    }

    

    /**
     * cap nhat cac don hang co san pham quan ly trong thang da thanh toan du
     */
    public function capNhatDonHangThuongSanPhamQuanLy(ThuongSanPhamQuanLy $thuong) : bool 
    {
        $nhomNhanVien = $thuong->nhomNhanVien();
        if($nhomNhanVien==null) {
            return false;
        }

        $dsSanPhamQuanLy = $this->getDsSanPhamQuanLyTheoNhomNhanVien($nhomNhanVien);
        
        $this->_capNhatDonHangThuongSanPhamTheoDanhSach($thuong,$dsSanPhamQuanLy);
        return true;
        
    }

    /**
     * cap nhat don hang thuong san pham theo danh sach san pham quan ly
     */
    private function _capNhatDonHangThuongSanPhamTheoDanhSach(ThuongSanPhamQuanLy $thuong, array $dsSanPhamQuanLy) : void{
        $dsDonHangDaThanhToanDu = $this->_dsDonHangChuaSanPhamDaThanhToanDu($thuong, $dsSanPhamQuanLy);
        $thuong->danhSachDonHangThuong()->sync($dsDonHangDaThanhToanDu);
    }

    // private function _capNhatDonHangThuongSanPhamTheoDanhSach(ThuongSanPhamQuanLy $)

    /**
     * mang chua danh sach don hang co san pham quan ly
     */
    private function _dsDonHangCoSanPhamQuanLy(array $dsSanPham) : ?array {
        $dsDonHang = DonHang::daThanhToanDu()->whereHas('sanPhams',function($query) use ($dsSanPham){
            $query->whereIn('id_san_pham',$dsSanPham);
        })->get()->pluck('id')->toArray();
        return $dsDonHang;
    }

    /**
     * don hang chua san pham quan ly da duoc thanh toan du
     */
    private function _dsDonHangChuaSanPhamDaThanhToanDu(ThuongSanPhamQuanLy $thuong, array $dsSanPhamQuanLy) : ?Collection {
        //lay danh sach id don hang co san pham la san pham quan ly        
        $dsDonHangCoSanPhamQuanLy = $this->_dsDonHangCoSanPhamQuanLy($dsSanPhamQuanLy);
        
        //lay thanh toan có ngay thanh toan max theo id don hang
        $dsThanhToanMax = $this->getDsMaxNgayThanhToan($dsDonHangCoSanPhamQuanLy);
        // dd($dsThanhToanMax->toArray());
        $dsDonThanhToanTrongThang = $this->getDsThanhToanTheoThangNam($thuong->thang,$thuong->nam, $dsThanhToanMax->pluck('id')->toArray());
        // dd($dsDonThanhToanTrongThang);
        //dung id don hang lam key cho array va chuyen ds ve array
        $dsDonThanhToanTrongThang = $dsDonThanhToanTrongThang->groupBy('id_don_hang')->toArray();
        $dsIDDonHangThanhToanTrongThang = array_keys($dsDonThanhToanTrongThang);
        $dsDonHangDuocTinhThuongCuaNhanVien = DonHang::select('id','doanh_so','doanh_thu','duoc_tinh_thuong','trang_thai','id_nhan_vien','ngay_tao_don','ngay_bat_dau_tinh_thoi_han','ngay_ket_thuc_tinh_thuong','ngay_nghiem_thu','so_ngay_tinh_cong_no','xac_nhan_vat')
            ->whereIn('id',$dsIDDonHangThanhToanTrongThang)
            ->get();


        return $dsDonHangDuocTinhThuongCuaNhanVien;

    }

    
}
