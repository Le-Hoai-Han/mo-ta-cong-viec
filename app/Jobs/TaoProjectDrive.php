<?php

namespace App\Jobs;

use App\Traits\DriveApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TaoProjectDrive implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use DriveApi;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $donHang;
    public $str;
    public function __construct($donHang,$str)
    {
        $this->donHang = $donHang;
        $this->str = $str;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        $this->postToDrive($this->str,$this->donHang);
    }
}
