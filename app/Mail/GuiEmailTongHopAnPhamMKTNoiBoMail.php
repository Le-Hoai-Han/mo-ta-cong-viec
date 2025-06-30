<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GuiEmailTongHopAnPhamMKTNoiBoMail extends Mailable
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
        return $this->view('template-email.tong-hop-an-pham-mkt-noi-bo')
        ->subject('3DS-er ơi! Tất cả tài liệu bạn có thể cần ở đây')
        ->with([
            'name' => $this->name,
        ]);
    }
}
