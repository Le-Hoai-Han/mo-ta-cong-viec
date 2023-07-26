<?php 
namespace App\Services\Thuong;

use App\Models\DonHang\DonHang;
use App\Models\Thuong\ChiTietNoXauDaTru;
use App\Models\Thuong\NoXauThuocNhanVien;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\HttpException;

// use App\Models\CongThuc\ChiTieuCaNhanTheoNam;
// use App\Models\Thuong\ThuongNamNhanVien;

class NoXauService
{
    /**
     * ket thuc khoan no xau thu cong
     */
    public function ketThucNoXau(NoXauThuocNhanVien $noXau) : void 
    {
        $noXau->ngay_ket_thuc = date('Y-m-d');
        $noXau->saveQuietly();
        
    }

    /**
     * phuc hoi lai khoan no xau chua thanh toan du
     */
    public function phucHoiNoXau(NoXauThuocNhanVien $noXau) : void 
    {
        $noXau->ngay_ket_thuc = null;
        $noXau->saveQuietly();
    }

    /**
     * luu no xau da tru
     * 
     */
    public function luuNoXauDaTru(ChiTietNoXauDaTru $noXauDaTru,$ngayTruNo,$soTien,$idNoXau) : bool 
    {
        $noXauDaTru->id_no_xau = $idNoXau;
        $noXauDaTru->so_tien = formatGiaTriDeLuu($soTien);
        $noXauDaTru->ngay_tru_no = formatNgayDeLuu($ngayTruNo);
        return $noXauDaTru->save();
    } 

    public function _validateDataNoXau(Request $request) {
        $validateData = $request->validate([
            'ma_don_hang'=>'required|exists:App\Models\DonHang\DonHang,ma_don_hang',
            'ngay_bat_dau'=>'required',
            'tong_so_tien'=>'required',
            'tien_da_tru'=>'required'
        ]);
        return $validateData;
    }
    /**
     * luu thong tin no xau
     */
    public function luuNoXau($idDonHang, $idNhanVien, $ngayBatDau, $tongSoTien, $tienDaTru) : NoXauThuocNhanVien 
    {
        $noXau = NoXauThuocNhanVien::firstOrNew([
            'id_don_hang'=>$idDonHang,
            'id_nhan_vien'=>$idNhanVien
        ],[
            'tong_so_tien'=>formatGiaTriDeLuu($tongSoTien)
        ]);
        
        $noXau->ngay_bat_dau = formatNgayDeLuu($ngayBatDau);
        $noXau->tien_da_tru = formatGiaTriDeLuu($tienDaTru);
        $noXau->save();
        return $noXau;
    }

    /**
     * cap nhat thi moi cap nhat tong so tien
     */
    public function capNhatThongTinNoXau($idDonHang, $idNhanVien, $ngayBatDau, $tongSoTien, $tienDaTru) {
        $noXau = NoXauThuocNhanVien::firstOrNew([
            'id_don_hang'=>$idDonHang,
            'id_nhan_vien'=>$idNhanVien
        ]);
        $noXau->tong_so_tien = formatGiaTriDeLuu($tongSoTien);
        $noXau->ngay_bat_dau = formatNgayDeLuu($ngayBatDau);
        $noXau->tien_da_tru = formatGiaTriDeLuu($tienDaTru);
        $noXau->save();
        return $noXau;
    }

    /**
     * tinh so tien tong no xau theo don hang
     */
    public function tinhTienNoXau(NoXauThuocNhanVien $noXau) : void
    {
        $donHang = $noXau->donHang;
        $soTienNoDonHang = $this->_tienNoDonHang($donHang);

        $soTienDaTruNo = $noXau->noXauDaTru->sum('so_tien');

        $noXau->tong_so_tien = $soTienNoDonHang;
        $noXau->tien_da_tru = $soTienDaTruNo;
        $noXau->save();        

    }

    /**
     * tinh tien don hang con no
     */
    private function _tienNoDonHang(DonHang $donHang) : float
    {
        $tienDaThanhToan = $donHang->thanhToanThuocDonHang->sum('so_tien_thanh_toan');
        if($donHang->doanh_thu > $tienDaThanhToan) {
            return $donHang->doanh_thu - $tienDaThanhToan;
        }
        return 0;
    }

  
}