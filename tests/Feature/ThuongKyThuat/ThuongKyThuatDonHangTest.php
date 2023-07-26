<?php

namespace Tests\Feature\ThuongKyThuat;

use App\Models\DonHang\DonHang;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThuongKyThuatDonHangTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tao_thuong_lap_dat()
    {
        $donHang = DonHang::find(21565);
        $thuongKyThuat = new ThuongKyThuatDonHang();
        $thuongKyThuat->tinhThuongLapDat($donHang);
        $this->assertTrue(true);
    }

    public function test_tao_thuong_dao_tao_mastercam() 
    {
        $donHang = DonHang::where('ma_don_hang','DH13155')->first();
        $thuongKyThuat = new ThuongKyThuatDonHang();
        $thuongKyThuat->tinhThuongDaoTaoMastercam($donHang);
        $this->assertTrue(true);
    }

    public function test_tao_thuong_cai_dat_mastercam() 
    {
        $donHang = DonHang::where('ma_don_hang','DH13638')->first();
        $thuongKyThuat = new ThuongKyThuatDonHang();
        $thuongKyThuat->tinhThuongCaiDatMastercam($donHang);
        $this->assertTrue(true);
    }

    public function test_tao_thuong_geomagic() 
    {
        $donHang = DonHang::find(204);
        $thuongKyThuat = new ThuongKyThuatDonHang();
        $thuongKyThuat->tinhThuongDaoTaoGeomagic($donHang);
        $this->assertTrue(true);
    }
}
