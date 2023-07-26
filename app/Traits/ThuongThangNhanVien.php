<?php 
namespace App\Traits;

use App\Models\DanhMucThangNam;
use App\Models\DonHang\DonHang;
use App\Models\Thuong\ThuongNhanVien;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;
use App\Traits\ThuongQuanLy\TienThuongSanPhamDonHangTrait;

trait ThuongThangNhanVien 
{
    use TienThuongSanPhamDonHangTrait;
    
    private function _tinhNganSachThuong(ThuongNhanVien $thuongNhanVien) : bool {
        if($thuongNhanVien->da_nhan_thuong !== ThuongNhanVien::TT_DA_NHAN_THUONG) {

            /**
             * nhan vien kinh doanh thi bang tong tien thuong don hang
             */
            if(!$thuongNhanVien->nhanVien->laKyThuat()) {
                $dsDonHang = $thuongNhanVien->donHangTinhThuongs;
                //cap nhat tinh thuong don hang
                // $thuongNhanVien->donHangTinhThuongs()->sync($dsDonHang);
                 
                $thuongNhanVien->ngan_sach_thuong = $dsDonHang->sum('tien_thuong_don_hang');
                
                
            } else {
                /**
                 * tinh toan cho nhan vien ky thuat
                 */
                $thuongNhanVien->ngan_sach_thuong = $this->_nganSachThuongKyThuat($thuongNhanVien);
            }

            $thuongNhanVien->ngan_sach_thuong += $this->_nganSachThuongQuanLySanPhamTheoNhom($thuongNhanVien); 

            $thuongNhanVien->save();
           
            return true;
        }
        return false;
        
        
    }

    /**
     * tinh ngan sach thuong cho ky thuat
     */
    private function _nganSachThuongKyThuat(ThuongNhanVien $thuongNhanVien) : float 
    {
        if(!$thuongNhanVien->nhanVien->laKyThuat()) {
            return 0;
        }
        $soTienThuongKyThuat = 0;

        $thangNamThuong = $thuongNhanVien->thangNam;
        $dsDonHangTrongThang = DonHang::select('id')
            ->whereMonth('ngay_nghiem_thu',$thangNamThuong->thang)
            ->whereYear('ngay_nghiem_thu',$thangNamThuong->nam)
            ->whereIn('trang_thai',DonHang::trangThaiDonThuongKyThuat())
            ->get()
            ->pluck('id')
            ->toArray();
        
        $dsTienThuongKyThuat = ThuongKyThuatDonHang::whereIn('id_don_hang',$dsDonHangTrongThang);
        if($thuongNhanVien->nhanVien->laTeamLapDatThietBi()) {
            $dsTienThuongKyThuat->laThuongLapDatHoacGeomagic();
            
        } else {
            $dsTienThuongKyThuat->laThuongMastercam();
        }
       
        $soTienThuongKyThuat = $dsTienThuongKyThuat->sum('so_tien_thuong');
                                    
        return $soTienThuongKyThuat;
    }


    

    // lay thang tinh thuong theo model thang nam
    public function getThangTinhThuong(DanhMucThangNam $thangNam) : int
    {
        return (int)$thangNam->thang;
    }

    //lay nam tinh thuong theo model thang nam
    public function getNamTinhThuong(DanhMucThangNam $thangNam) : int
    {
        return (int)$thangNam->nam;
    }

   
    /**
     * get thuongNhanVien model
     */
    static public function loadThuongNhanVien($idNhanVien,$thang,$nam) : ?ThuongNhanVien
    {
        return ThuongNhanVien::where([
            ['id_nhan_vien',$idNhanVien]
            ])->whereHas('thangNam',function($query) use ($thang,$nam) {
                $query->where('thang',$thang);
                $query->where('nam',$nam);
            
            })->orderBy('id_thang_nam','ASC')->first();
    }
    
   
    /**
     * tinh ngan sach thuong cho cac nhan vien co quan ly san pham
     */
    private function _nganSachThuongQuanLySanPhamTheoNhom(ThuongNhanVien $thuongNhanVien) : float {
        $nhanVien = $thuongNhanVien->nhanVien;
        //không phải quản lý nhóm thì không có sản phẩm quản lý
        if(!$nhanVien->laQuanLy()) {
            return 0;
        }

        //thuoc nhóm nhân viên không có sản phẩm quản lý thì không có ngân sách từ phần này
        $nhomNhanVien = $nhanVien->nhomNhanVien;
        if($nhomNhanVien->loaiSanPham->isEmpty()) {
            return 0;
        }

        $thuongSanPhamQuanLy = $nhanVien->thuongSanPhamQuanLy()->where([
            'thang' => $thuongNhanVien->thangNam->thang,
            'nam' => $thuongNhanVien->thangNam->nam
        ])->first();

        $this->capNhatThuongSanPhamQuanLy($thuongSanPhamQuanLy);
        return $thuongSanPhamQuanLy->so_tien_thuong;    
        
    }

}