<?php

namespace App\Jobs;

use App\Mail\GuiMailVeAdmin;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class GuiMailChoAdmin implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $donHang;
    public function __construct($donHang)
    {
        $this->donHang=$donHang;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('khanh.tran@3ds.vn')
                ->cc(['han.le@3ds.vn'])
                ->send(new GuiMailVeAdmin($this->donHang));
    }
}
