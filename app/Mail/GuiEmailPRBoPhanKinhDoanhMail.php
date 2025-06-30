<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiEmailPRBoPhanKinhDoanhMail extends Mailable
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
        return $this->view('template-email.pr-bo-phan-kinh-doanh')
        ->subject('3DS-er ơi! Cốt lõi kinh doanh của chúng ta là gì?')
        ->with([
            'name' => $this->name,
        ]);
    }
}
