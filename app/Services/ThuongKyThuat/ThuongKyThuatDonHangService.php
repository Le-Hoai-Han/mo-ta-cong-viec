<?php 
namespace App\Services\ThuongKyThuat;

use App\Models\DonHang\DonHang;
use App\Models\Thuong\ThuongNhanVien;
use App\Traits\ThuongKyThuat\ThuongCaiDatMastercamTrait;
use App\Traits\ThuongKyThuat\ThuongDaoTaoGeomagicTrait;
use App\Traits\ThuongKyThuat\ThuongDaoTaoMastercamTrait;
use App\Traits\ThuongKyThuat\ThuongLapDatTrait;
use App\Traits\ThuongThangNhanVien;

class ThuongKyThuatDonHangService
{ 
    use ThuongLapDatTrait;
    use ThuongCaiDatMastercamTrait;
    use ThuongDaoTaoMastercamTrait;
    use ThuongThangNhanVien;
    use ThuongDaoTaoGeomagicTrait;

    /**
     * tinh thuong ky thuat cho don hang
     */
    public function tinhThuongDonHang(DonHang $donHang) : bool 
    {
        $this->tinhThuongLapDat($donHang);
        $this->tinhThuongCaiDatMastercam($donHang);
        $this->tinhThuongDaoTaoMastercam($donHang);
        $this->tinhThuongDaoTaoGeomagic($donHang);
        return true;
    }

    /**
     * tinh lai ngan sach thuong cua 1 nhân vien khi co nhu cau
     */
    public function tinhLaiNganSachThuongKyThuat(ThuongNhanVien $thuongNhanVien) : void {

        $thangNamThuong = $thuongNhanVien->thangNam;
        $dsDonHangTrongThang = DonHang::whereMonth('ngay_nghiem_thu',$thangNamThuong->thang)
                                    ->whereYear('ngay_nghiem_thu',$thangNamThuong->nam)
                                    ->whereIn('trang_thai',DonHang::trangThaiDonThuongKyThuat())
                                    ->select('id')
                                    ->get();
    
        
        foreach($dsDonHangTrongThang as $donHang) {
            $this->tinhThuongDonHang($donHang);            
        }

        $this->_tinhNganSachThuong($thuongNhanVien);
    }
}