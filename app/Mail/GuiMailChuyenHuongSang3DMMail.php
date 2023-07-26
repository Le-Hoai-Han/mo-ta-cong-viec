<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiMailChuyenHuongSang3DMMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $donHang;
    public $nguoiLienHe;
    public $tenCongTy;
    public function __construct($donHang,$nguoiLienHe,$tenCongTy)
    {
        $this->donHang=$donHang;
        $this->nguoiLienHe=$nguoiLienHe;
        $this->tenCongTy=$tenCongTy;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('template-email.email-chuyen-huong-sang-3DM')
        ->subject('Mail điều hướng 3Dmanufacturer ')
        ->with([
            'donHang'=>$this->donHang,
            'nguoiLienHe'=>$this->nguoiLienHe,
            'tenCongTy'=>$this->tenCongTy,
        ]);
    }
}
