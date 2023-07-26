<?php

namespace App\Console\Commands;

use App\Jobs\CapNhatDonHangTestJob;
use App\Jobs\CapNhatTatCaDH;
use Illuminate\Console\Command;

class CapNhatDonHangTest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'donhang:cap-nhat-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cập nhật đơn hàng test';

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
        for($i=100;$i<101;$i++){
            $offset = $i*$limit;
            CapNhatDonHangTestJob::dispatch( $limit, $offset);
            //->delay(now()->addMinutes(1));
        }
        return 0;
    }
}
