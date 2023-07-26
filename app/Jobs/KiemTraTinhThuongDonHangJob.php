<?php

namespace App\Jobs;

use App\Traits\GetflyApi;
use App\Traits\KhachHang\ThongTinKhachHang;
use App\Traits\TinhThuongDonHang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KiemTraTinhThuongDonHangJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use TinhThuongDonHang;
    use GetflyApi;
    use ThongTinKhachHang;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $donHang;
    public function __construct($donHang)
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
        $this->_kiemTraTinhThuongDonHang($this->donHang);
    }
}
