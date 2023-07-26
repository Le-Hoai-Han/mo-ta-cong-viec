<?php

namespace Tests\Feature\Thuong;

use App\Models\CongThuc\ChiTieuCaNhanThoiGian;
use App\Models\CongThuc\DanhSachChiTieu;
use App\Models\Thuong\ThuongKhoangThoiGian;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use ReflectionClass;
use Tests\TestCase;

class ThuongKhoangThoiGianModelTest extends TestCase
{
    use DatabaseTransactions;
    protected function setUp():void
    {
        
        parent::setUp();
        $this->artisan("db:seed");
        
    }
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_tim_model_dau_tien()
    {
        $thuong = ThuongKhoangThoiGian::first();        
        $this->assertInstanceOf(ThuongKhoangThoiGian::class,$thuong);
        
    }

    public function test_tim_model_theo_thang_nam_nhan_vien() 
    {        
        $thang = 3;
        $nam = date('Y');
        $nhanVien = 1;
        $thuong = (new ThuongKhoangThoiGian)->getQuyCanTinh($thang,$nam,$nhanVien);
        $this->assertInstanceOf(ThuongKhoangThoiGian::class,$thuong);
    }

    public function test_tim_chi_tieu_theo_id() 
    {        
        $thuong = ThuongKhoangThoiGian::first();
        $reflectionClass = new ReflectionClass($thuong);
        $layChiTieuFunc = $reflectionClass->getMethod('_layChiTieuThuocThuongTheoIDChiTieu');
        $layChiTieuFunc->setAccessible(true);

        $idNhom = 1;
        $idChiTieu = DanhSachChiTieu::getIdChiTieuDoanhSoTheoNhom($idNhom);
        $result = $layChiTieuFunc->invokeArgs($thuong,[$idChiTieu]);
        $this->assertInstanceOf(ChiTieuCaNhanThoiGian::class,$result);

        $idNhom = 10000; 
        $idChiTieu = DanhSachChiTieu::getIdChiTieuDoanhSoTheoNhom($idNhom);
        $result = $layChiTieuFunc->invokeArgs($thuong,[$idChiTieu]);
        $this->assertNull($result);
    }

    public function test_lay_muc_tieu_doanh_so_quy()
    {
        $testData = [
            'thang'=>3,
            'nam'=>date('Y'),
            'id_nhan_vien'=>1,
            'id_nhom'=>1
        ];

        $mucTieu = (new ThuongKhoangThoiGian)->getMucTieuDoanhSoQuy($testData['id_nhan_vien'],$testData['thang'],$testData['nam'],$testData['id_nhom']);
// dd($mucTieu);
        $this->assertNotEquals(0,$mucTieu);
        $this->assertIsFloat($mucTieu);
        
    }
}
