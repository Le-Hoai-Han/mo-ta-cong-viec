<?php 

namespace App\Services\DonHang;

use App\Jobs\GuiMailAdminKhiSaleChuaXNVATJob;
use App\Jobs\GuiMailChoAdmin;
use App\Jobs\GuiMailChoKHKhiDHDuyet;
use App\Jobs\GuiMailKHKhiDHDuyetJob;
use App\Jobs\GuiMailXacNhanVATJob;
use App\Mail\GuiMailKhiDuyetDonHang;
use App\Mail\GuiMailVeAdmin;
use App\Mail\TestGuiMail;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\DonHangDaDuyet;
use App\Models\NhanVien;
use App\Models\User;
use App\Notifications\GuiMailKhiDonHangDaDuyet;
use App\Traits\DonHang\GetDataDHGetfly;
use App\Traits\DonHang\GuiMailDonDaDuyet;
use App\Traits\DonHang\LoadDonHang;
use App\Traits\GetflyApi;
use App\Traits\GuiMailAdmin;
use App\Traits\ParseDataDH;
use App\Traits\TinhThuongDonHang;
use Aws\Api\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Traits\HasHash;
use App\Traits\ParseDataKH;

class DonHangService 
{
    use TinhThuongDonHang;
    use GetflyApi;
    use Queueable;
    use ParseDataKH;
    use ParseDataDH;
    use HasHash;
    use GetDataDHGetfly;
    use LoadDonHang;
    use GuiMailDonDaDuyet;
    use GuiMailAdmin;

    public function huyDon($maDonHang) : bool 
    {
        $donHang = $this->loadDonHang($maDonHang);
        if($donHang==null) {
            return false;
        }
        $donHang->trang_thai = DonHang::TT_HUY;
        $donHang->duoc_tinh_thuong = DonHang::KHONG_TINH_THUONG;
        
        //save() return true
        return $donHang->save();
    }

    

    /**
     * tim nhan vien theo ho ten nhan vien
     */
    public function checkNhanVien($hoTenNV) : ?NhanVien
    {
        return NhanVien::where([
            ['ho_ten', '=', $hoTenNV]
        ])->first();
    }

    // Validate đơn hang

    public function validateOrder($data){
        $validate = Validator::make($data, [
            'ma_don_hang' => 'required',
            'doanh_so' => 'required',
            'doanh_thu' => 'required',
            'ten_nguoi_tao' => 'nullable',
            'ngay_thuc_hien' => 'required',
            "so_tien_thanh_toan_moi_nhat" => "required",
            "ngay_hien_tai" => "required",
            "gio_hien_tai" => "required",
            "tien_thuong_don_hang" => "nullable",
            "chi_phi_phat_sinh"=>'nullable',
            "chi_phi_khac"=>'nullable',
            "la_nguon_marketing"=>'nullable',
            "la_don_hang_thanh_ly"=>'nullable',
            "dat_lai"=>'nullable',
            "ngay_nghiem_thu"=>"nullable",
            'id_khach_hang'=>'nullable',
            "so_ngay_tinh_cong_no"=>'nullable',
            "ten_nguoi_lien_he"=>'nullable',
            'quy_rui_ro'=>'nullable',
            "phi_van_chuyen_cua_don_hang"=>'nullable'
        ])->validated();

        return $validate;
    }

    
    

    // Tạo data đơn hàng
    public function createData($data){

        $attributeList=$this->validateOrder($data);
        $maDonHang = $attributeList['ma_don_hang'];

        // $url = "/orders/". $maDonHang;
        // $jsonData = json_decode( $this->getToGetFly($maDonHang,$url));
        // $dataGetFly = json_decode(json_encode($jsonData),true);
        // $dataDonHang = $dataGetFly['order_info'];
        $dataGetFly = $this->getDonHangTuGetFlyDecode($maDonHang);
        $dataDonHang = $this->getOrderInfo($dataGetFly);
        // Nếu đơn hàng có tên "PROJECT hoặc 3dm" thì tên người tạo là 3DM
        // check mã đơn hàng 3DM
        $checkDH3DM=$this->checkDH3DM($maDonHang);
        if($checkDH3DM){
            $hoTen=config('services.3dm.ten_nguoi_tao');
        }else{
            $reg = '/_+/';        
            $hoTen = preg_replace($reg, ' ', $attributeList['ten_nguoi_tao']);
        }

        $attributeList['ten_nguoi_tao'] = $hoTen;
        $attributeList['chi_phi_phat_sinh'] = (double) $attributeList['chi_phi_phat_sinh'];
        $attributeList['chi_phi_khac'] = (double) $attributeList['chi_phi_khac'];
        $attributeList['la_nguon_marketing'] = ($attributeList['la_nguon_marketing']=="Yes") ? 1 : 0;
        $attributeList['la_don_hang_thanh_ly'] = ($attributeList['la_don_hang_thanh_ly']=="Yes") ? 1 : 0;
        $attributeList['dat_lai'] = ($attributeList['dat_lai']=="Yes") ? 1 : 0;
        $attributeList['so_ngay_tinh_cong_no'] = ($attributeList['so_ngay_tinh_cong_no']!=null) ? $attributeList['so_ngay_tinh_cong_no'] : 0;
        $attributeList['ten_nguoi_lien_he'] = ($attributeList['ten_nguoi_lien_he']!= null) ? $attributeList['ten_nguoi_lien_he'] : '';
        $attributeList['quy_rui_ro'] = ($attributeList['quy_rui_ro']!= null) ? $attributeList['quy_rui_ro'] : '';
        $attributeList['phi_van_chuyen_cua_don_hang'] = $dataDonHang['transport_amount'];
       
        // check nhân viên
        $nhanVien=$this->checkNhanVien($hoTen);
        
    //    Nếu tìm ko được nhân viên thì mặc định là 3D Smart Solutions
        if ($nhanVien !== null) {
            $attributeList['id_nhan_vien'] = $nhanVien->id;
        } else {
            $attributeList['id_nhan_vien'] = config('services.3ds.id_nguoi_tao'); //nguoi test 3D Smart Solution
        }


        $ngayThucHien = str_replace('/', '-', $attributeList['ngay_thuc_hien']);
        $ngayNghiemThu = str_replace('/', '-', $attributeList['ngay_nghiem_thu']);
        unset($attributeList['ngay_thuc_hien']);
        unset($attributeList['ngay_nghiem_thu']);
        $attributeList['ngay_tao_don'] = date('Y-m-d', strtotime($ngayThucHien));
        // Check ngày nghiệm thu đủ ngày tháng năm
        $arrDateNgayTT=explode('-',$ngayThucHien);
        $arrDateNgayNT=explode('-',$ngayNghiemThu);
    
        if(count( $arrDateNgayNT) <3 && $ngayNghiemThu != ''){
            // Nếu số tháng của ngày nghiệm thu lớn hơn tháng của ngày tạo đơn hàng
        
            if( $arrDateNgayNT[1] > $arrDateNgayTT[1]){
                $attributeList['ngay_nghiem_thu']=date('Y-m-d',strtotime($ngayNghiemThu.'-'.$arrDateNgayTT[2]));
            }else{
                $attributeList['ngay_nghiem_thu']=date('Y-m-d',strtotime('+1 year',strtotime($ngayNghiemThu.'-'.$arrDateNgayTT[2])));
            }
        }else{
            $attributeList['ngay_nghiem_thu'] = date('Y-m-d', strtotime($ngayNghiemThu));
        }
        $attributeList['id_khach_hang']=  $dataDonHang['account_id'];
        // lay token cho đơn hàng
        $attributeList['token']= $this->generateHash() .$attributeList['ma_don_hang'];
        return $attributeList;
    }

    // check đơn hàng trong bảng support đơn hàng đã duyệt
    public function checkDonHangDaDuyet($donHang){
        $check=DonHangDaDuyet::where('id_don_hang',$donHang->id)->first();
        if($check != null){
            return true;
        }
        return false;
    }

    
    // Gửi mail cho khach hàng và các bộ phận liên quan
    public function guiMailKhachHang($nguoiLienHe,$emailNguoiPhuTrach,$donHang,$tenCongTy){
        $maDonHang=$donHang->ma_don_hang;
        $url = "/orders/". $maDonHang;
        $jsonData=json_decode($this->getToGetFly($maDonHang,$url));
        $dataSP=$jsonData->products;
        
        Mail::to('hanhoai08091996@gmail.com')
        // Mail::to($nguoiLienHe['email'])
        ->cc(['khanh.tran@3ds.vn','lehoaihan08091996@gmail.com'])
        ->send(new GuiMailKhiDuyetDonHang($donHang,$nguoiLienHe,$dataSP,$tenCongTy));
    }


    //  //  Lưu đơn hàng đã duyệt vào bảng support đơn hàng
    // public function luuDonHangDaDuyet($donHang){
    //         $idNguoiPhuTrach=$donHang->nhanVien->user->id;
    //         $emailNguoiPhuTrach=$donHang->nhanVien->user->email;
    //         $checkSendMail=true;
    //         $trang_thai=0;
    //         // tim người liên hệ
    //         $nguoiLienHe= $this->timNguoiLienHe($donHang);
    //         // TÌm tên công ty khách hàng
    //         $tenCongTy=$this->timTenCongTy($donHang);
    //         $emailNguoiLienHe = null;
    //          if(!empty($nguoiLienHe)){
                
    //              if($nguoiLienHe['email'] != null){
    //                  $emailNguoiLienHe =$nguoiLienHe['email'];
    //                 }else{
    //                     $trang_thai = DonHangDaDuyet::TT_LOI_NGUOI_LIEN_HE;
    //                     $checkSendMail=false;
    //                 }

    //             if($idNguoiPhuTrach == DonHang::ID_USER_ROOT || $idNguoiPhuTrach == DonHang::ID_USER_3DM 
    //                 ||$idNguoiPhuTrach == DonHang::ID_USER_3DS){
    //                 $trang_thai =DonHangDaDuyet::TT_LOI_NGUOI_TAO_DON;
    //                 $checkSendMail=false;
    //                 $emailNguoiPhuTrach= '';
    //             }
    //         }else{
    //             $trang_thai = DonHangDaDuyet::TT_LOI_NGUOI_LIEN_HE;
    //             $checkSendMail=false;
    //         }

    //         $arrDonHangDaDuyet=[
    //             'id_don_hang'=>$donHang->id,
    //             'id_khach_hang'=>$donHang->id_khach_hang,
    //             'email_nguoi_lien_he'=>$emailNguoiLienHe,
    //             'trang_thai'=>$trang_thai,
    //         ];
    //         // dd($arrDonHangDaDuyet);
           
    //         $donHangDaDuyet= DonHangDaDuyet::create($arrDonHangDaDuyet);
           
    //         // Gửi mail 
            
    //         $check3DM=$this->checkDH3DM($donHang->ma_don_hang);
    //     if(!$check3DM && $donHang->donHangBDTuNgay('2023-02-01') && $checkSendMail == true && $donHangDaDuyet->trang_thai != DonHangDaDuyet::TT_THANH_CONG ){
    //          // Gửi mail cho admin khi thông tin gửi mail đã hợp lệ nhưng Sale chưa xác nhận VAT 
    //         if($donHang->donHangNotVAT() && $donHang->xac_nhan_vat == DonHang::TT_VAT_CHUA_XAC_NHAN){
    //             GuiMailAdminKhiSaleChuaXNVATJob::dispatch($donHang)->delay(now()->addMinute(1));
    //         }else{
    //             // Nếu thông tin gửi mai hợp lệ và đơn hàng đã có VAT rồi thì gửi mail 
    //              // Gửi mail cho khách hàng và cc sale và các bộ phận liên quan
    //             GuiMailKHKhiDHDuyetJob::dispatch($donHang,$nguoiLienHe,$emailNguoiPhuTrach,$tenCongTy)->delay(now()->addMinutes(1));
    //         }
            
    //     // // Đổi trạng thái gửi email
    //     $donHangDaDuyet->trang_thai= DonHangDaDuyet::TT_THANH_CONG;
    //     $donHangDaDuyet->save();
    //     }
           
    //         if($donHangDaDuyet->trang_thai == DonHangDaDuyet::TT_LOI_NGUOI_TAO_DON || $donHangDaDuyet->trang_thai == DonHangDaDuyet::TT_LOI_NGUOI_LIEN_HE){
    //             // Gửi mail về cho admin
    //             $this->guiMailAdmin($donHang);
                
    //         }
           

    // }

    // /**
    //  * kiem tra nguoi phu trach co thuoc vao nhom admin hoac khong gui mail hay khong
    //  */
    // public function nguoiPhuTrachLaUserHeThong($idNguoiPhuTrach) : bool
    // {
    //     //danh sach id user he thong 
    //     $dsIdHeThong = [
    //         DonHang::ID_USER_ROOT,
    //         DonHang::ID_USER_3DM,
    //         DonHang::ID_USER_3DS
    //     ];

    //     // neu nguoi tao thuoc mang nay thi return false;
    //     if(in_array($idNguoiPhuTrach,$dsIdHeThong))
    //         return true;
    //     return false;

            
    // }
    
}