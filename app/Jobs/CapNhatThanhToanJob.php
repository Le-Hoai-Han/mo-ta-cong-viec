<?php

namespace App\Jobs;

use App\Models\DonHang\ThanhToanThuocDonHang;
use App\Models\Thuong\ThuongMoMoi;
use App\Models\Thuong\TMMDonHangKhachHang;
use App\Traits\DonHang\CheckThanhToanDu;
use App\Traits\DonHang\GetDataDHGetfly;
use App\Traits\DonHang\LoadDonHang;
use App\Traits\ParseDataDH;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Traits\DonHang\GuiMailDonDaDuyet;
use App\Traits\DonHang\GuiMailDonDaThanhToanDu;
use App\Traits\ParseDataKH;
use App\Traits\KhachHang\ThongTinKhachHang;
use App\Traits\ThuongMoMoiTrait;

class CapNhatThanhToanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use ParseDataDH;
    use GetDataDHGetfly;
    use LoadDonHang;
    use CheckThanhToanDu;
    use ParseDataKH;
    use ThongTinKhachHang;
    use GuiMailDonDaDuyet;
    use GuiMailDonDaThanhToanDu;
    use ThuongMoMoiTrait;
    
    public $ma_don_hang;

    public $uniqueFor = 5;

    public function uniqueId()
    {
        return $this->ma_don_hang;
    }
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($maDonHang)
    {
        $this->ma_don_hang = $maDonHang;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dataDH = $this->getDonHangTuGetFly($this->ma_don_hang);
        
        $dsThanhToan = $dataDH->payments;

        $donHang = $this->loadDonHang($this->ma_don_hang);
        
        if($donHang == null){
            return;
        }
        $donHang->thanhToanThuocDonHang()->delete();

        foreach($dsThanhToan as $thanhToan) {
            $thanhToanThuocDonHang = new ThanhToanThuocDonHang();
            $thanhToanThuocDonHang->id_don_hang = $donHang->id;
            $thanhToanThuocDonHang->so_tien_thanh_toan = formatGiaTriDeLuu(thuGonSoLe($thanhToan->amount,0));
            $thanhToanThuocDonHang->ngay_thanh_toan = formatNgayDeLuu($thanhToan->pay_date);
            $thanhToanThuocDonHang->da_cap_nhat = 0;
            $thanhToanThuocDonHang->saveQuietly();
        }
        
        KiemTraTinhThuongDonHangJob::dispatch($donHang)->delay(now()->addSeconds(3));
        if($this->checkThanhToanDu($donHang)) {
            // Gửi api lên getfly để duyệt đơn hàng
            duyetGetfly::dispatch($donHang->ma_don_hang); 

            // Nếu đơn hàng thuộc các danh mục (thiết kế ngược,thiết kế khuôn,....)
            // Gửi api qua drive để gửi email kích hoạt tài khoản cho khách hàng
            ThanhToanDuDrive::dispatch($donHang,'don-hang-thanh-toan-du')->delay(now()->addSecond(3));


            // Kiểm tra xem có phải đơn 3Dm không
            if(!($this->checkDH3DM($donHang->ma_don_hang)) ){
                $maxNgayThanhToan=$donHang->thanhToanThuocDonHang()->max('ngay_thanh_toan');
                // Thêm vào bảng thưởng mở mới

                // Tìm đơn hàng đầu tiên của khách hàng
                $donHangDauTien = $donHang->donHangDauTien->donHang;

                if( $donHangDauTien != null){
                    $donHangKhachHang = $donHangDauTien->khachHang->TMMDonHangKhachHang;
                    if( $donHangKhachHang != null &&  $donHangKhachHang->trang_thai == TMMDonHangKhachHang::TT_DUOC_TINH_THUONG){
                        $ngayKetThucDHThuongMoMoi= $donHangKhachHang->ngay_ket_thuc;

                        // Nếu đơn hàng có ngày thanh toán đủ nhỏ hơn ngày kết thúc TT thì lưu đơn hàng vào
                        // bảng đơn hàng thưởng mở mới
                        if($ngayKetThucDHThuongMoMoi >= $maxNgayThanhToan){
                            $sanPhamMoMoi=$donHang->sanPhamThuongMoMoi;

                            // Lấy tổng số tiền thưởng để lưu vào bảng đơn hàng thưởng mở mới
                            $soTienThuong=0;
                            $danhMucThangNam = $this->__getDanhMucThangNam($maxNgayThanhToan);
                            foreach($sanPhamMoMoi as $sanPham){
                                $soTienThuong+=(($sanPham->gia_san_pham)*($sanPham->so_luong))*($sanPham->ti_le_thuong/100);
                            }
                            $arrDHTMM=[
                                    'id_khach_hang_don_hang'=>$donHangKhachHang->id,
                                    'id_don_hang'=>$donHang->id,
                                    'id_thang_nam'=>$danhMucThangNam->id,
                                    'so_tien_thuong'=>$soTienThuong,
                                    'da_nhan_thuong'=>0,
                                    'ngay_thanh_toan_du'=>$maxNgayThanhToan,
                                    'id_nhan_vien'=>$donHang->id_nhan_vien
                                ];
                            
                                // Thêm đơn hàng vào bảng đơn hàng thưởng mở mới
                                    if($this->_loadDonHangThuongMoMoi($donHang->id) == null){
                                        $donHangKhachHang->donHangThuongMoMoi()->create($arrDHTMM);
                                    }
                            }
                            
                        }
                    };

                }
                // Kiểm tra đơn hàng dịch vụ
                $checkDHDV=true;
                foreach($donHang->sanPhams as $sanPham){
                    if($sanPham->danhMucSanPham->checkDHDV() != true){
                        $checkDHDV=false;
                    }

                if($checkDHDV == true && date('Y-m-d',strtotime($maxNgayThanhToan)) == date('Y-m-d') ){
                    $dsKhachHang = $this->getDataShowKH($donHang->id_khach_hang);
                    if($dsKhachHang == null){
                        if(!$this->checkIssetDH_TT_Du($donHang)){
                            $this->luuDonHangLoiShowKH_TT_Du($donHang);
                            GuiMailChoAdmin::dispatch($donHang)->delay(now()->addMinutes(1));
                        }
                    }else{
                        $dsNguoiLienHe = $this->layDanhSachNguoiLienHe($dsKhachHang);
                        $nguoiLienHe = $this->timNguoiLienHe($donHang,$dsNguoiLienHe);
                        $tenCongTy=$this->timTenCongTy($dsKhachHang);
                        GuiMailChuyenHuongSang3DMJob::dispatch($donHang,$nguoiLienHe,$tenCongTy)->delay(now()->addSecond(10));
                    }
                }
            }
        }
    }
}
