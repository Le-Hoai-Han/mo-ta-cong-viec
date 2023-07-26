<?php

namespace App\Jobs;

use App\Models\DonHang\DonHang;
use App\Traits\GetflyApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CapNhatDonHangTestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use GetflyApi;

    private $offset;
    private $limit;
    private $data;
    public function __construct($limit,$offset)
    {
        $this->offset = $offset;
        $this->limit = $limit;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = $this->getToGetFly([
            'offset'=>$this->offset,
            'limit'=>$this->limit,
            'order_type'=>2
        ],'orders');

        $listOrder=(json_decode($data)->records);
        // \Log::debug($listOrder);
        foreach($listOrder as $order){

            $checkDonHangNull = $this->__checkDonHangNull($order->order_code);
            if($checkDonHangNull) { 
                // CreateDonHang::dispatch($order)->delay(now()->addMinutes(1));
                CreateDonHangTest::dispatch($order)->delay(now()->addMinutes(1));
                
            }
            // else{
            //     UpdateDonHang::dispatch($order)->delay(now()->addMinutes(1));
            // }
        }
    }

    
    public function __checkDonHangNull($maDonHang) : bool
    {
        $donHang = DonHang::where('ma_don_hang',$maDonHang)->first();
        if($donHang == null){
            return true;
        }

        return false;
    }
}
