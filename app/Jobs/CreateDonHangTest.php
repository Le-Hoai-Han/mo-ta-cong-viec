<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CreateDonHangTest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        \Log::debug($this->order->order_code);
        $response = Http::withHeaders([
            'accept'=>'application/json',
            'Authorization'=> 'Bearer '.config('services.khach-hang.key')
        ])->get(route('api.them-don-test',$this->order->order_code));
        \Log::debug($response);
        return 1;
        // return Http::withHeaders([
        //     'accept'=>'application/json',
        //     'Authorization'=>config('services.khach-hang.key')
        // ])->get(route('donHangGetfly.store',$this->order->order_code)); 
    }
}
