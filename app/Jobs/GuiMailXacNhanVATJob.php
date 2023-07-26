<?php

namespace App\Jobs;

use App\Mail\GuiMailXacNhanVATMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GuiMailXacNhanVATJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('hanhoai08091996@gmail.com')
        ->cc(['lehoaihan08091996@gmail.com'])
        ->send(new GuiMailXacNhanVATMail($this->donHang,$this->emailSale,$this->link));
    }
}
