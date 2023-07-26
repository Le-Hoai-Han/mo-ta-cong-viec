<?php

namespace App\Traits\DonHang;

use App\Jobs\GuiMailAdminKhiSaleChuaXNVATJob;
use App\Jobs\GuiMailChoAdmin;
use App\Jobs\GuiMailKHKhiDHDuyetJob;
use App\Mail\GuiMailVeAdmin;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\DonHangDaDuyet;
use App\Models\NhanVien\NhomNhanVien;
use App\Traits\KhachHang\ThongTinKhachHang;

trait GuiMailDonDaDuyet
{
    use KiemTraNguoiPhuTrach;
    use ThongTinKhachHang;
    // Tìm tên khách hàng
    public function timTenCongTy($dataKhachHang)
    {
        $tenCongTy = $dataKhachHang['khachHang']['ten_khach_hang'];

        return $tenCongTy;
    }

    //  Lưu đơn hàng đã duyệt vào bảng support đơn hàng
    public function luuDonHangDaDuyet($donHang)
    {
        $idNguoiPhuTrach = $donHang->nhanVien->user->id;
        $emailNguoiPhuTrach = $donHang->nhanVien->user->email;
        $checkSendMail = true;
        $trang_thai = 0;
        $dsKhachHang = $this->getDataShowKH($donHang->id_khach_hang);
        $emailNguoiLienHe = null;

        // check đơn 3DM
        $check3DM = $this->checkDH3DM($donHang->ma_don_hang);
         // Nếu gọi show KH lỗi thì gọi hàm lưu Đơn hàng lỗi;
         if($dsKhachHang == null && !$check3DM){
            $this->luuDonHangLoiShowKH($donHang);
            GuiMailChoAdmin::dispatch($donHang)->delay(now()->addMinutes(1));
        }

        $dsNguoiLienHe = $this->layDanhSachNguoiLienHe($dsKhachHang);
        $nguoiLienHe = $this->timNguoiLienHe($donHang, $dsNguoiLienHe);

        /**
         * nếu người liên hệ null hoặc email null thì checkSend = false
         */
        if (!empty($nguoiLienHe) && $nguoiLienHe['email'] != null) {
            $emailNguoiLienHe = $nguoiLienHe['email'];
        } else {
            $trang_thai = DonHangDaDuyet::TT_LOI_NGUOI_LIEN_HE;
            $checkSendMail = false;
        }

        // TÌm tên công ty khách hàng
        $tenCongTy = $this->timTenCongTy($dsKhachHang);

        if ($this->nguoiPhuTrachLaUserHeThong($idNguoiPhuTrach)) {

            $trang_thai = DonHangDaDuyet::TT_LOI_NGUOI_TAO_DON;
            $checkSendMail = false;
            $emailNguoiPhuTrach = '';
        }

        $arrDonHangDaDuyet = [
            'id_don_hang' => $donHang->id,
            'id_khach_hang' => $donHang->id_khach_hang,
            'email_nguoi_lien_he' => $emailNguoiLienHe,
            'trang_thai' => $trang_thai,
        ];
        // dd($arrDonHangDaDuyet);

        $donHangDaDuyet = DonHangDaDuyet::create($arrDonHangDaDuyet);

        // Gửi mail 
       
        if (!$check3DM && $checkSendMail == true && $donHangDaDuyet->trang_thai != DonHangDaDuyet::TT_THANH_CONG) {
           
            // Nếu thông tin gửi mai hợp lệ và đơn hàng đã có VAT rồi thì gửi mail 
            // Gửi mail cho khách hàng và cc sale và các bộ phận liên quan
            GuiMailKHKhiDHDuyetJob::dispatch($donHang, $nguoiLienHe, $emailNguoiPhuTrach, $tenCongTy)->delay(now()->addMinutes(1));

            // Đổi trạng thái gửi email
            $donHangDaDuyet->trang_thai = DonHangDaDuyet::TT_THANH_CONG;
            $donHangDaDuyet->save();
        }

        if ($donHangDaDuyet->trang_thai == DonHangDaDuyet::TT_LOI_NGUOI_TAO_DON || $donHangDaDuyet->trang_thai == DonHangDaDuyet::TT_LOI_NGUOI_LIEN_HE) {
            // Gửi mail về cho admin
            $this->guiMailAdmin($donHang);
        }
    }

    public function luuDonHangLoiShowKH($donHang){
        $arrDonHangDaDuyet=[
            'id_don_hang'=>$donHang->id,
            'id_khach_hang'=>$donHang->id_khach_hang,
            'trang_thai'=>DonHangDaDuyet::TT_LOI_TT_KH
        ];

        DonHangDaDuyet::create($arrDonHangDaDuyet);
    }
}
