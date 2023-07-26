<?php

namespace Tests\Unit\KhachHang;

use App\Traits\KhachHang\ThongTinKhachHang;
use PHPUnit\Framework\TestCase;

class ThongTinKhachHangTest extends TestCase
{
    use ThongTinKhachHang;
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_tim_danh_xung_func()
    {
        //return Mr
        $tenNguoi = "Tran Nhat Khanh (Mr)";
        $danhXung = $this->timDanhXungKH($tenNguoi);
        $this->assertEquals("(Mr)",$danhXung);

        $tenNguoi = "Tran Thi B (Mrs)";
        $danhXung = $this->timDanhXungKH($tenNguoi);
        $this->assertEquals("(Mrs)",$danhXung);

        $tenNguoi = "Tran Nhat Khanh";
        $danhXung = $this->timDanhXungKH($tenNguoi);
        $this->assertEquals("",$danhXung);

        $tenNguoi = "Tran Nhat Khanh (Anh)";
        $danhXung = $this->timDanhXungKH($tenNguoi);
        $this->assertEquals("(Anh)",$danhXung);

        $tenNguoi = "Tran Nhat Khanh ()";
        $danhXung = $this->timDanhXungKH($tenNguoi);
        $this->assertEquals("()",$danhXung);
    }
}
