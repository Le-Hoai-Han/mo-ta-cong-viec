<?php

namespace App\Mail;

use App\Models\DonHang\DonHangDaDuyet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiMailKhiDuyetDonHang extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $donHang;
    public $nguoiLienHe;
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('template-email.email-duyet-don-hang')
        ->subject('3DS triển khai đơn hàng '.$this->donHang->ma_don_hang)
        ->with([
            'donHang'=>$this->donHang,
            'nguoiLienHe'=>$this->nguoiLienHe,
            'emailNguoiPhuTrach'=>$this->emailNguoiPhuTrach,
            'tenCongTy'=>$this->tenCongTy
        ]);
    }
}
