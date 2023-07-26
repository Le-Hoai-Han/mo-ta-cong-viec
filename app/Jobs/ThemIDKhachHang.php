<?php

namespace App\Jobs;

use App\Traits\GetflyApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ThemIDKhachHang implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use GetflyApi;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private  $dataDonHang;
    public function __construct($dataDonHang)
    {
        $this->dataDonHang=$dataDonHang;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->dataDonHang as $donHang){
            $url = "/orders/". $donHang->ma_don_hang; 
            $jsonData = json_decode( $this->getToGetFly($donHang->ma_don_hang,$url));
            $dataGetFly = json_decode(json_encode($jsonData),true);
            $dataDonHang=$dataGetFly['order_info'];
            $donHang->id_khach_hang = $dataDonHang['account_id'];
            $donHang->save();
    }
    }
}
