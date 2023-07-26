<?php

namespace App\Jobs;

use App\Models\DonHang\DonHang;
use App\Services\ThuongKyThuat\ThuongKyThuatDonHangService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KiemTraThuongKyThuatJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $donHang;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(DonHang $donHang)
    {
        $this->donHang = $donHang;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new ThuongKyThuatDonHangService();
        $service->tinhThuongDonHang($this->donHang);
    }
}
