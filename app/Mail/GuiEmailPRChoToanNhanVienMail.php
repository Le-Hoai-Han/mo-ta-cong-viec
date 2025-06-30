<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiEmailPRChoToanNhanVienMail extends Mailable
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('template-email.pr-cho-toan-nhan-vien')
        ->subject('3DS-er ơi! Sứ Mệnh, Tầm Nhìn & Slogan của chúng ta là gì?')
        ->with([
            'name' => $this->name,
        ]);
    }
}
