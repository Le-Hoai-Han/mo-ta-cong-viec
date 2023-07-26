<?php

namespace Tests\Feature\CongThuc;

use App\Models\CongThuc\DanhSachChiTieu;
use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Services\Thuong\ThuongThoiGianService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChiTieuThoiGianTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cap_nhat_chi_tieu_thuong()
    {
        $this->artisan('db:seed');
        $thuongThoiGian = ThuongKhoangThoiGian::where([
            'id_nhan_vien'=>1,
            'nam'=>date('Y'),
            'thang_bat_dau'=>1,
            'thang_ket_thuc'=>3
        ])->get()->first();
        $thuongThoiGianService = new ThuongThoiGianService();
        $thuongThoiGianService->capNhatChiTieuCongDon($thuongThoiGian);
        $chiTieu = $thuongThoiGian->chiTieuCaNhanTheoThoiGian->first();
        $this->assertNotEquals(0,$chiTieu->ket_qua);

    }
}
