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

class CapNhatTatCaDH implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use GetflyApi;

    private $offset;
    private $limit;
    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
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

        $listDonHang=(json_decode($data)->records);
        $i=0;
        $arrMaDH=[];
        foreach($listDonHang as $item){
            if(strpos($item->order_code,' ') == false){
                $arrMaDH[]=$item->order_code;
            }
        }
        // \Log::debug($arrMaDH);
        $loadDonHang=$this->__loadDonHang( $arrMaDH);
        if($loadDonHang != null){
            $donHang=array_diff( $arrMaDH, $loadDonHang);
        }else{
            $donHang = $arrMaDH;
        }

        foreach( $donHang as $maDonHang){
                CreateDonHang::dispatch( $maDonHang)->delay(now()->addMinutes($i));
                $i++;
            }
            // else{
            //     UpdateDonHang::dispatch($order)->delay(now()->addMinutes(1));
            // }
        
        // \Log::debug($data);
        // echo $this->offset."\n";
    }

    public function __loadDonHang( $arrMaDH){
        $donHang=DonHang::whereIn('ma_don_hang', $arrMaDH)->get()->pluck('ma_don_hang')->toArray();
        if($donHang != null){
            return $donHang;
        }
    }
}
