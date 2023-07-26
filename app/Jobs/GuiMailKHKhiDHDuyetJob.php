<?php

namespace App\Jobs;

use App\Mail\GuiMailKhiDuyetDonHang;
use App\Models\DonHang\DonHangDaDuyet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GuiMailKHKhiDHDuyetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    public $nguoiLienHe;
    public $donHang;
    public $emailNguoiPhuTrach;
    public $tenCongTy;
    public function __construct($donHang,$nguoiLienHe,$emailNguoiPhuTrach,$tenCongTy)
    {
        $this->donHang= $donHang;
        $this->nguoiLienHe= $nguoiLienHe;
        $this->emailNguoiPhuTrach= $emailNguoiPhuTrach;
        $this->tenCongTy= $tenCongTy;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->donHang->sanPhams->isEmpty()){
            \Log::debug("Không tìm thấy sản phẩm trên hệ thống");
            GuiMailChoAdmin::dispatch($this->donHang);
        }

        $ccEmails = collect([
            $this->emailNguoiPhuTrach,
            'hotrokythuat@3ds.vn',
            'admin@3ds.vn',
            'Sales.Administrator@3ds.vn',
        ])->filter();
        Mail::to($this->nguoiLienHe['email'])
            ->cc($ccEmails)
            ->bcc('han.le@3ds.vn')
            ->send(new GuiMailKhiDuyetDonHang($this->donHang,$this->nguoiLienHe,$this->emailNguoiPhuTrach,$this->tenCongTy));

            // Đổi trạng thái gửi mail sang thành công
            $donHangDaDuyet = DonHangDaDuyet::where('id_don_hang',$this->donHang->id)->first();
            if($donHangDaDuyet){
                $donHangDaDuyet->update(['trang_thai'=>DonHangDaDuyet::TT_THANH_CONG]);
            }
    }
}
