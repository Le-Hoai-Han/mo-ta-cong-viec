<?php

namespace App\Console\Commands;

use App\Models\DonHang\DonHang as DonHangDonHang;
use App\Models\Profile;
use App\Services\DonHang\DonHangService;
use Illuminate\Console\Command;

class DonHang extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donhang:tinhthuong';

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
    public function handle(DonHangDonHang $donHang,DonHangService $service)
    {
        $donHangAll =DonHangDonHang::all();
        foreach($donHangAll as $donHang ){
            $service->_kiemTraTinhThuongDonHang($donHang);
        }

    }
}
