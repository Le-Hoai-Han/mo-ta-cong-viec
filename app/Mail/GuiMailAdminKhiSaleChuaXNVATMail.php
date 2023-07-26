<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiMailAdminKhiSaleChuaXNVATMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $donHang;
    public function __construct($donHang)
    {
        $this->donHang= $donHang;
    }   

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('template-email.template-sale-chua-xac-nhan-vat')
        ->subject('Sale chưa xác nhận VAT đơn hàng '.$this->donHang->ma_don_hang)
        ->with([
            'donHang'=>$this->donHang
        ]);
    }
}
