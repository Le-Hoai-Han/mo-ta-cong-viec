<?php

namespace Tests\Feature\Thuong;

use App\Models\CongThuc\ChiTieuCaNhan;
use App\Models\CongThuc\CongThucTinh;
use App\Models\CongThuc\DanhSachChiTieu;
use App\Models\DanhMucThangNam;
use App\Models\Thuong\KetQuaTinhThuong;
use App\Models\Thuong\ThuongNhanVien;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class KetQuaCongDonQuyTest extends TestCase
{
    use DatabaseTransactions;

    protected $id_nhom_nhan_vien = 1;

    protected function setUp() : void 
    {
        parent::setUp();
        $this->artisan('db:seed');
    }
    /**
     * Test xem co ton tai cong thuc quy theo nhom khong
     */
    public function test_tim_cong_thuc_quy_theo_nhom()
    {
        $congThuc = CongThucTinh::where('noi_dung','like','%MUC_TIEU_DOANH_SO_QUY%')->where('id_nhom_nhan_vien',$this->id_nhom_nhan_vien)->first();
        $this->assertInstanceOf(CongThucTinh::class,$congThuc);
    }

    /**
     * chekc xem co ton tai chi tieu doanh so theo nhom dang test ko 
     */
    public function test_tim_chi_tieu_doanh_so_theo_nhom()
    {
        $chiTieu = DanhSachChiTieu::getChiTieuDoanhSoTheoNhom($this->id_nhom_nhan_vien);
        $this->assertInstanceOf(DanhSachChiTieu::class,$chiTieu);
    }

    /**
     * test chi tieu doanh so cua ca nhan co loi hay khong
     */
    public function test_tim_chi_tieu_doanh_so_ca_nhan_theo_thang()
    {
        $idNhanVien = 1;
        $thang = 1;
        $nam = date('Y');
        $thangNam = DanhMucThangNam::where('thang',$thang)->where('nam',$nam)->first();        
        
        $chiTieuThang = ChiTieuCaNhan::getDoanhSoCongDonTheoThang($thangNam->id,$idNhanVien,$this->id_nhom_nhan_vien);
        $this->assertIsFloat($chiTieuThang);
    }

    public function test_noi_dung_thay_doi_cong_thuc_cong_don_quy()
    {
        $idNhanVien = 15;
        $thang = 2;
        $nam = date('Y');

        $congThuc = CongThucTinh::where('noi_dung','like','%MUC_TIEU_DOANH_SO_QUY%')->where('id_nhom_nhan_vien',$this->id_nhom_nhan_vien)->first();

        $thangNam = DanhMucThangNam::where('thang',$thang)->where('nam',$nam)->first();  
        $this->assertInstanceOf(DanhMucThangNam::class,$thangNam);

        $thuongNhanVien = ThuongNhanVien::updateOrCreate([
            'id_nhan_vien'=>$idNhanVien,
            'id_thang_nam'=>$thangNam->id
        ],[
            'ngan_sach_thuong'=>0
        ]);
        // dd($thuongNhanVien);
        $this->assertInstanceOf(ThuongNhanVien::class,$thuongNhanVien);

        $ketQuaTinhThuong = KetQuaTinhThuong::updateOrCreate([
            'id_cong_thuc'=>$congThuc->id,
            'id_thuong_nhan_vien'=>$thuongNhanVien->id
        ],
        [
            'noi_dung_cong_thuc'=>$congThuc->noi_dung
            ] );
        $this->assertInstanceOf(KetQuaTinhThuong::class,$ketQuaTinhThuong);

        $noiDungMoi = KetQuaTinhThuong::thayCongThucTinhDoanhSoCongDonTheoQuy($ketQuaTinhThuong->noi_dung_cong_thuc,$idNhanVien,$this->id_nhom_nhan_vien,$thangNam);
        $this->assertNotEquals($noiDungMoi,$ketQuaTinhThuong->noi_dung_cong_thuc);
        $this->assertIsString($noiDungMoi);
    }

    

}
