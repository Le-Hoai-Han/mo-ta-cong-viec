<?php

namespace App\Jobs\ThuongQuanLy;

use App\Models\NhanVien\NhomNhanVien;
use App\Traits\ThuongQuanLy\KhoiTaoThuongSanPhamTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class KhoiTaoThuongQuanLySanPhamJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use KhoiTaoThuongSanPhamTrait; 
    
    private $thang;
    private $nam;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($thang = 1, $nam = 2023)
    {
        $this->thang = $thang;
        $this->nam = $nam;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dsNhom = NhomNhanVien::whereNotNull('id_quan_ly')->get();

        foreach($dsNhom as $nhom) {
            $this->khoiTaoThongTinThuong($this->thang, $this->nam, $nhom->id_quan_ly);
        }
    }
}
