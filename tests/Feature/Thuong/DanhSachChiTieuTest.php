<?php

namespace Tests\Feature\Thuong;

use App\Models\CongThuc\DanhSachChiTieu;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DanhSachChiTieuTest extends TestCase
{
    
    /**
     * test chi tieu doanh so theo nhom tra ve khac null
     */
    public function test_chi_tieu_doanh_so_theo_nhom()
    {
        $idNhomNhanVien = 1; //sale
        $chiTieu = DanhSachChiTieu::getChiTieuDoanhSoTheoNhom($idNhomNhanVien);        
        $this->assertInstanceOf(DanhSachChiTieu::class,$chiTieu);        
    }

    /**
     * test chi tieu doanh so theo nhom tra ve null
     */
    public function test_chi_tieu_doanh_so_theo_nhom_khong_ton_tai()
    {
        $idNhomNhanVien = 1000; //sale
        $chiTieu = DanhSachChiTieu::getChiTieuDoanhSoTheoNhom($idNhomNhanVien);        
        $this->assertNotInstanceOf(DanhSachChiTieu::class,$chiTieu);
        $this->assertNull($chiTieu);
    }

    /**
     * test id chi tieu doanh so theo nhom
     */
    public function test_id_chi_tieu_doanh_so_theo_nhom() 
    {
        $idNhomNhanVien = 1;
        $idChiTieu = DanhSachChiTieu::getIdChiTieuDoanhSoTheoNhom($idNhomNhanVien);        
        $this->assertIsInt($idChiTieu);
        $this->assertNotEquals(0,$idChiTieu);
        

        $idNhomNhanVien = 9999;
        $idChiTieuFail = DanhSachChiTieu::getIdChiTieuDoanhSoTheoNhom($idNhomNhanVien);  
        $this->assertEquals(0,$idChiTieuFail);
        
    }


}
