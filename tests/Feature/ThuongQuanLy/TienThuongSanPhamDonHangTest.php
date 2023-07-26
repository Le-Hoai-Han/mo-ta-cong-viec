<?php

namespace Tests\Feature\ThuongQuanLy;

use App\Models\DonHang\DonHang;
use App\Models\NhanVien\NhomNhanVien;
use App\Traits\ThuongQuanLy\TienThuongSanPhamDonHangTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TienThuongSanPhamDonHangTest extends TestCase
{
    use TienThuongSanPhamDonHangTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_danh_sach_don_hang_chua_san_pham_quan_ly()
    {
        $nhom = NhomNhanVien::where([['ten_nhom','like','%Supervisor Production%']])->first();
        $thuong = $nhom->quanLy->thuongSanPhamQuanLy->first();
        $ketQua = $this->capNhatDonHangThuongSanPhamQuanLy($thuong);
        $this->assertTrue($ketQua);
        
        /**
         * khong null & la don han
         */
        $donHang = $thuong->danhSachDonHangThuong->first();
        $this->assertInstanceOf(DonHang::class,$donHang);
        // $this->
    }

    public function test_tinh_tien_thuong_quan_ly() {
        $nhom = NhomNhanVien::where([['ten_nhom','like','%Supervisor Production%']])->first();
        $thuong = $nhom->quanLy->thuongSanPhamQuanLy->first();
        $this->capNhatThuongSanPhamQuanLy($thuong);
        $this->assertTrue(true);
    }
}
