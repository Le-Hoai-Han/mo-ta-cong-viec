<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class UpdateDonHang implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $order;
    public function __construct($order)
    {
        $this->order =$order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // \Log::debug(Http::get(route('donHangGetfly.store',$this->order->order_code)));
        return Http::withHeaders([
            'accept'=>'application/json',
            'Authorization'=>config('services.khach-hang.key')
        ])->get(route('donHangGetfly.update',$this->order->order_code)); 
    }
}
