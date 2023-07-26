<?php

namespace App\Jobs;

use App\Mail\GuiMailChuyenHuongSang3DMMail;
use App\Mail\GuiMailVeAdmin;
use App\Models\DonHang\DonHangDaDuyet;
use App\Models\DonHang\DonHangDaThanhToanDu;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GuiMailChuyenHuongSang3DMJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $donHang;
    public $nguoiLienHe;
    public $tenCongTy;
    public function __construct($donHang,$nguoiLienHe,$tenCongTy)
    {
        $this->donHang= $donHang;
        $this->nguoiLienHe= $nguoiLienHe;
        $this->tenCongTy= $tenCongTy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $donHang = $this->donHang;
        $khachHang = $donHang->khachHang;
        $emailNguoiLienHe = data_get($this->nguoiLienHe, 'email');

        // Kiểm tra nếu đơn hàng đã được thanh toán hoặc khách hàng đã có trong bảng thì không xử lý tiếp
        if (DonHangDaThanhToanDu::where('id_don_hang', $donHang->id)->exists() || DonHangDaThanhToanDu::where('id_khach_hang', $khachHang->id)->exists()) {
            return;
        }

        // Nếu không tìm thấy email người liên hệ hoặc khách hàng thì không gửi mail và thông báo lỗi
        if (!$emailNguoiLienHe || !$khachHang) {
            DonHangDaThanhToanDu::create([
                'id_don_hang' => $donHang->id,
                'id_khach_hang' => $khachHang->id,
                'email_nguoi_lien_he' => $emailNguoiLienHe,
                'trang_thai' => DonHangDaThanhToanDu::TT_LOI_NGUOI_LIEN_HE
            ]);
            
            GuiMailChoAdmin::dispatch($donHang);
            return;
        }

        DonHangDaThanhToanDu::create([
        'id_don_hang' => $donHang->id,
        'id_khach_hang' => $khachHang->id,
        'email_nguoi_lien_he' => $emailNguoiLienHe,
        'trang_thai' => DonHangDaThanhToanDu::TT_THANH_CONG
    ]);
        
       
    // Gửi mail
    Mail::to($emailNguoiLienHe)
    ->bcc(['han.le@3ds.vn'])
    ->send(new GuiMailChuyenHuongSang3DMMail($this->donHang,$this->nguoiLienHe,$this->tenCongTy));
    }
}
