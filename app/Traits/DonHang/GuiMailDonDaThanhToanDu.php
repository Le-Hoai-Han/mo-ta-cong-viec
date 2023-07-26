<?php

namespace App\Traits\DonHang;

use App\Jobs\GuiMailAdminKhiSaleChuaXNVATJob;
use App\Jobs\GuiMailChoAdmin;
use App\Jobs\GuiMailKHKhiDHDuyetJob;
use App\Mail\GuiMailVeAdmin;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\DonHangDaDuyet;
use App\Models\DonHang\DonHangDaThanhToanDu;
use App\Models\NhanVien\NhomNhanVien;
use App\Traits\KhachHang\ThongTinKhachHang;

trait GuiMailDonDaThanhToanDu
{
    use KiemTraNguoiPhuTrach;
    use ThongTinKhachHang;

    public function luuDonHangLoiShowKH_TT_Du($donHang){
        $arrDonHangDaThanhToanDu=[
            'id_don_hang'=>$donHang->id,
            'id_khach_hang'=>$donHang->id_khach_hang,
            'trang_thai'=>DonHangDaDuyet::TT_LOI_TT_KH
        ];

        DonHangDaThanhToanDu::create($arrDonHangDaThanhToanDu);
    }

    public function checkIssetDH_TT_Du($donHang){
        $checkDonHang=DonHangDaThanhToanDu::where('id_don_hang',$donHang->id)->first();
        if($checkDonHang != null){
            return true;
        }
        return false;

    }
}
