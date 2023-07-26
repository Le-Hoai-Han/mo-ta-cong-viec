<?php

namespace App\Jobs;

use App\Traits\GetflyApi;
use App\Traits\SanPham;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CapNhatSanPham implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use SanPham;
    use GetflyApi;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $idDonHang;
    public function __construct($idDonHang)
    {
        $this->idDonHang =$idDonHang;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->capNhatSanPham($this->idDonHang);
    }
}
