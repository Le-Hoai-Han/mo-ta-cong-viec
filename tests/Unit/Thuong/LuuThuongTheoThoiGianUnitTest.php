<?php

namespace Tests\Unit\Thuong;

use App\Services\Thuong\ThuongThoiGianService;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use ReflectionClass;
//lam viec voi db thi phai dung testcase nay thay vi cua phpunit
use Tests\TestCase;


class LuuThuongTheoThoiGianUnitTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_luu_chi_tieu()
    {
        $this->artisan('db:seed');
        $testData = [
            'id_thuong_thoi_gian'=>1,
            'id_chi_tieu'=>7,
            'muc_tieu'=>5000000,
            'id_nguoi_cap_nhat'=>1
        ];

        $thuong = new ThuongThoiGianService();
       

        $result = $thuong->luuChiTieuThoiGian($testData['id_thuong_thoi_gian'],$testData['id_chi_tieu'],$testData['muc_tieu'],$testData['id_nguoi_cap_nhat']);
        $this->assertTrue($result);
        $this->assertDatabaseHas('cms___chi_tieu_ca_nhan_thoi_gian',$testData);
    }
}
