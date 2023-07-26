<?php

namespace Tests\Feature\ThuongQuanLy;

use App\Models\DonHang\LoaiSanPham;
use App\Models\NhanVien\NhomNhanVien;
use App\Traits\ThuongQuanLy\LoaiSanPhamQuanLyTrait;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ThuongSanPhamQuanLyTest extends TestCase
{
    use LoaiSanPhamQuanLyTrait;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_loai_san_pham()
    {
        $nhom = NhomNhanVien::where([['ten_nhom','like','%Supervisor Production%']])->first();
        $dsLoai = $this->dsLoaiSanPhamQuanLyTheoNhomNhanVien($nhom);
        $this->assertIsArray($dsLoai);
        $this->assertNotEmpty($dsLoai);
    }

    /**
     * test ham ds sp theo ds loai
     */
    public function test_danh_sach_san_pham_theo_loai() {
        $nhom = NhomNhanVien::where([['ten_nhom','like','%Supervisor Production%']])->first();
        
        $dsLoai = $this->dsLoaiSanPhamQuanLyTheoNhomNhanVien($nhom);
        $dsSanPham = $this->getDsSanPhamTheoDsLoai($dsLoai);
        $this->assertIsArray($dsSanPham);
        $this->assertNotEmpty($dsSanPham);
    }

    /**
     * test ham sp quan ly theo nhom nv
     */
    public function test_danh_sach_san_pham_quan_ly() {
        $nhom = NhomNhanVien::where([['ten_nhom','like','%Supervisor Production%']])->first();
        
        $dsLoai = $this->dsLoaiSanPhamQuanLyTheoNhomNhanVien($nhom);
        $dsSanPham = $this->getDsSanPhamTheoDsLoai($dsLoai);

        $dsSanPhamQuanLy = $this->getDsSanPhamQuanLyTheoNhomNhanVien($nhom);
        $this->assertIsArray($dsSanPhamQuanLy);
        $this->assertNotEmpty($dsSanPhamQuanLy);
        $this->assertEquals($dsSanPham,$dsSanPhamQuanLy);

        
    }
}
