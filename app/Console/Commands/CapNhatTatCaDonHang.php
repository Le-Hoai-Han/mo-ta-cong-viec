<?php

namespace App\Console\Commands;

use App\Jobs\CapNhatTatCaDH;
use App\Models\DonHang\DonHangGetFly;
use App\Models\NhanVien;
use App\Services\DonHang\DonHangGetFlyService;
use App\Services\DonHang\DonHangService;
use Illuminate\Console\Command;

class CapNhatTatCaDonHang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donhang:capNhatTatCaDonHang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $limit = 50;
        for($i=0;$i<230;$i++){
            $offset = $i*$limit;
            CapNhatTatCaDH::dispatch( $limit, $offset)->delay(now()->addMinutes(2*$i));
        }
        return 0;
    }
}
