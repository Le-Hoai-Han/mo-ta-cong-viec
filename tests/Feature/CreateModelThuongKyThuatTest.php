<?php

namespace Tests\Feature;

use App\Models\DonHang\DanhMucSanPham;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\LoaiSanPham;
use App\Models\NhanVien\NhomNhanVien;
use App\Models\ThuongKyThuat\LoaiSanPhamQuanLy;
use App\Models\ThuongKyThuat\LoaiThuongKyThuat;
use App\Models\ThuongKyThuat\SoTienThuongKyThuat;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class CreateModelThuongKyThuatTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Test tạo model và relation loai san pham quan ly theo nhom
     *
     * @return void
     */
    public function test_model_loai_san_pham_quan_ly()
    {
        $loaiSp = LoaiSanPham::first();
        $nhomNhanVien = NhomNhanVien::first();

        $loaiSanPhamQuanLy = LoaiSanPhamQuanLy::create([
            'id_loai_san_pham'=>$loaiSp->id,
            'id_nhom_nhan_vien'=>$nhomNhanVien->id
        ]);

        $this->assertInstanceOf(LoaiSanPhamQuanLy::class,$loaiSanPhamQuanLy);

        //relation
        $this->assertInstanceOf(LoaiSanPham::class,$loaiSanPhamQuanLy->loaiSanPham);
        $this->assertEquals($loaiSp->id,$loaiSanPhamQuanLy->loaiSanPham->id);
        $this->assertInstanceOf(NhomNhanVien::class,$loaiSanPhamQuanLy->nhomNhanVien);
        $this->assertEquals($nhomNhanVien->id,$loaiSanPhamQuanLy->nhomNhanVien->id);
    }

    /**
     * test model và relation so tien thuong ky thuat
     */
    public function test_model_so_tien_thuong_ky_thuat() 
    {
        // $danhMucSanPham = DanhMucSanPham::limit(3)->get();

        $nhomNhanVien = NhomNhanVien::first();
        $soTienThuongKyThuat = SoTienThuongKyThuat::create([
            'id_nhom_nhan_vien'=>$nhomNhanVien->id,
            'tien_thuong_co_ban'=>1000,
            'tien_thuong_vuot_muc'=>800,
            'so_luong_gioi_han'=>2
            
        ]);

        $this->assertInstanceOf(SoTienThuongKyThuat::class,$soTienThuongKyThuat);

        //relation
        $this->assertInstanceOf(NhomNhanVien::class,$soTienThuongKyThuat->nhomNhanVien);
        $this->assertEquals($nhomNhanVien->id,$soTienThuongKyThuat->nhomNhanVien->id);

        //test tao danh muc thuong 
        $danhMucSanPham = DanhMucSanPham::limit(3)->get();
        $soTienThuongKyThuat->tienThuongTheoSanPhams()->sync($danhMucSanPham);
        $tienThuongTheoSanPham = $soTienThuongKyThuat->tienThuongTheoSanPhams;
        $this->assertInstanceOf(DanhMucSanPham::class,$tienThuongTheoSanPham->first());
        $this->assertEquals($danhMucSanPham->first()->ma_san_pham,$tienThuongTheoSanPham->first()->ma_san_pham);

    }

    /**
     * test model loai thuong ky thuat 
     */
    public function test_model_loai_thuong_ky_thuat()
    {
        $loaiThuongKyThuat = LoaiThuongKyThuat::create([
            'ma_loai'=>'LAP_DAT_THIET_BI',
            'ten_loai'=>'Lắp đặt thiết bị',
            'mo_ta' => ''
        ]);
        $this->assertInstanceOf(LoaiThuongKyThuat::class,$loaiThuongKyThuat);
    }

    /**
     * test model thuong ky thuat theo don hang
     */
    public function test_model_thuong_ky_thuat_theo_don_hang() 
    {
        Artisan::call("db:seed --class=LoaiThuongKyThuatSeeder");
        $loaiThuongKyThuat = LoaiThuongKyThuat::first();
        $donHang = DonHang::first();

        $thuongKyThuatDonHang = ThuongKyThuatDonHang::create([
            'id_loai'=>$loaiThuongKyThuat->id,
            'id_don_hang'=>$donHang->id,
            'so_tien_thuong'=>10000,
            'mo_ta'=>'Tiền thưởng test',
            'ngay_cap_nhat'=>date('Y-m-d H:i:s')
        ]);

        $this->assertInstanceOf(ThuongKyThuatDonHang::class,$thuongKyThuatDonHang);

        //relation
        $this->assertInstanceOf(DonHang::class,$thuongKyThuatDonHang->donHang);
        $this->assertEquals($donHang->id,$thuongKyThuatDonHang->donHang->id);
        $this->assertInstanceOf(LoaiThuongKyThuat::class,$thuongKyThuatDonHang->loaiThuongKyThuat);
        $this->assertEquals($loaiThuongKyThuat->id,$thuongKyThuatDonHang->loaiThuongKyThuat->id);


        //relation cua loai thuong ky thuat
        $this->assertInstanceOf(ThuongKyThuatDonHang::class,$loaiThuongKyThuat->thuongKyThuatDonHangs->first());
    }


}
