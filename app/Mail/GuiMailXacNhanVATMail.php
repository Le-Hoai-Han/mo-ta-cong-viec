<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiMailXacNhanVATMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $donHang;
    public $emailSale;
    public $link;
    public function __construct($donHang,$emailSale,$link)
    {
        $this->donHang=$donHang;
        $this->emailSale=$emailSale;
        $this->link=$link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('template-email.thong-bao-sale-xac-nhan-VAT')
                    ->subject('Xác nhận đơn hàng' .$this->donHang->ma_don_hang)
                    ->with([
                        'donHang'=>$this->donHang,
                        'emailSale'=>$this->emailSale,
                        'link'=>$this->link,
                    ]);
    }
}
