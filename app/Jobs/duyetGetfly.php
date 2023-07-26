<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\GetflyApi;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Support\Facades\Http;

class duyetGetfly implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use GetflyApi;
    private $data = [
        'order_code'=>""
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($orderCode)
    {
        $this->data['order_code'] = $orderCode;
    }

   /* 
    public function middleware()
    {
        return [(new WithoutOverlapping($this->order->id))->dontRelease()];
    }*/

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $response = Http::withHeaders([
            'X-API-KEY' => config('services.getfly.key')
        ])->post("https://3ds.getflycrm.com/api/v3/orders/approve", $this->data);
        return $response->body();
    }
}
