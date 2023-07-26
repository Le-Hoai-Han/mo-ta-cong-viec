<?php

namespace App\Jobs;

use App\Models\DonHang\DonHang;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class CreateDonHang implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $orderCode;
    public function __construct($orderCode)
    {
        $this->orderCode =$orderCode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        return Http::withHeaders([
            'accept'=>'application/json',
            'Authorization'=>config('services.khach-hang.key')
        ])->get(route('queue.them-don-hang',$this->orderCode)); 
    }
}
