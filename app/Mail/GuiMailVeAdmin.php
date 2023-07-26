<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiMailVeAdmin extends Mailable
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
        return $this->view('template-email.thong-bao-cho-admin')
        ->subject('[3DS] Lỗi thông tin đơn hàng') 
        ->with([
            'donHang'=>$this->donHang 
        ]);
    }
}
