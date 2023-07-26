<?php

namespace App\Jobs\Thuong;

use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Services\Thuong\ThuongThoiGianService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CapNhatThuongQuyJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dsThuongQuy = ThuongKhoangThoiGian::where([
            ['thang_ket_thuc','<=',date('m')],
            ['nam','=',date('Y')],
            ['loai','=',ThuongKhoangThoiGian::LOAI_THUONG_QUY]
        ])->whereNull('ngay_khoa_phat_thuong')->get();

        if($dsThuongQuy == null) 
            return 0;
        
        $service = new ThuongThoiGianService();
        foreach($dsThuongQuy as $thuongQuy) {
            $thuongQuy->thongTinTienThuongThoiGian();
            $thuongQuy = $service->tinhTienThuong($thuongQuy);
            $thuongQuy = $service->tinhKetQuaCongThuc($thuongQuy);
            $thuongQuy = $service->tinhTienThuongConlai($thuongQuy);
        }


        
        
    }
}
