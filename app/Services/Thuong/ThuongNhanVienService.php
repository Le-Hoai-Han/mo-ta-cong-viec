<?php 

namespace App\Services\Thuong;

use App\Models\CongThuc\ChiTieuCaNhan;
use App\Models\CongThuc\CongThucTinh;
use App\Models\CongThuc\DanhSachHangMucThuong;
use App\Models\DanhMucThangNam;
use App\Models\DonHang\DonHang;
use App\Models\NhanVien;
use App\Models\Thuong\KetQuaTinhThuong;
use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Models\Thuong\ThuongNhanVien;
use App\Models\Thuong\ThuongNhanVienTheoHangMuc;
use App\Models\ThuongKyThuat\LoaiThuongKyThuat;
use App\Models\ThuongKyThuat\SoTienThuongKyThuat;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;
use App\Traits\TinhThuongDonHang;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


class ThuongNhanVienService 
{
    use TinhThuongDonHang;
    // public function xoaDeTest()
    // {
    //     ChiTieuCaNhan::where('id','>=',1)->delete();
        
    //     KetQuaTinhThuong::where('id','>=',1)->delete();
    //     ThuongNhanVienTheoHangMuc::where('id','>=',1)->delete();
    //     ThuongNhanVien::where('id','>=',1)->delete();

    // }

    //luu chi tieu ca nhan
    //luu ket qua tinh thuong
    //luu thuong hang muc - cong thuc
    /**
     * @param $dsNhanVienID
     * @param $dsThangNamID
     * @param $dsChiTieu
     * @param $idCongThuc
     * @param $idHangMuc
     */
    public function themThuongNhanVien($dsNhanVienID,$dsThangNamID,$dsChiTieu,$idNhomNhanVien) {
        $hangMuc = DanhSachHangMucThuong::where('id_nhom_nhan_vien',$idNhomNhanVien)->firstOrCreate([
            'id_nhom_nhan_vien'=>$idNhomNhanVien
        ],[
            'ten_hang_muc'=>'Hạng mục thưởng '.$idNhomNhanVien,
            'mo_ta'=>'Thưởng theo tháng'
        ]);
        $congThuc = CongThucTinh::where('id_nhom_nhan_vien',$idNhomNhanVien)->orderBy('la_cong_thuc_chinh','DESC')->first();
        // $this->xoaDeTest();
        // dd($congThuc);
        $dsNhanVien = NhanVien::whereIn('id', $dsNhanVienID)->get();
        foreach($dsNhanVien as $nhanVien) {
            
            foreach($dsThangNamID as $thangID) {
                //them thuong nhan vien - thang
                $thuongNhanVien = $this->_timHoacThemThuongNhanVien($thangID,$nhanVien->id);
                if($hangMuc!=null && $congThuc!==null) {
                    $idHangMuc = $hangMuc->id;
                    $idCongThuc = $congThuc->id;
                    //khong dung hang muc thuong nua
                    ThuongNhanVienTheoHangMuc::firstOrCreate([
                        'id_hang_muc'=>$idHangMuc,
                        'id_thuong_nhan_vien'=>$thuongNhanVien->id
                    ]);
                 
                    $ketQuaTinhThuong = KetQuaTinhThuong::firstOrNew([
                        'id_cong_thuc' => $idCongThuc,
                        'id_hang_muc'=>$idHangMuc,
                        'id_thuong_nhan_vien' => $thuongNhanVien->id,
                    ]);
                    $ketQuaTinhThuong->save();
                    
                    
                }
             
                $this->_themChiTieuCaNhan($dsChiTieu,$nhanVien->id,$thangID);
                
            }
        }
    }

    //them chi tieu ca nhan
    private function _themChiTieuCaNhan($dsChiTieu,$nhanVienID,$thangID) : void
    {
        foreach($dsChiTieu as $chiTieuID=>$mucTieu) {
            $chiTieuCaNhan = ChiTieuCaNhan::firstOrNew([
                'id_chi_tieu'=>$chiTieuID,
                'id_nhan_vien'=>$nhanVienID,
                'id_thang_nam'=>$thangID
            ]);
            
            $chiTieuCaNhan->muc_tieu = formatGiaTriDeLuu($mucTieu);
            $chiTieuCaNhan->save();
        }
    }

    //load model ket qua tinh thuong
    private function _getKetQuaTinhThuong($idHangMuc,$idCongThuc,$idThuongNhanVien) : ?KetQuaTinhThuong
    {
        return KetQuaTinhThuong::where([
            'id_hang_muc' => $idHangMuc,
            'id_cong_thuc' => $idCongThuc,
            'id_thuong_nhan_vien' => $idThuongNhanVien,

        ])->first();
    }


    /**
     * builder dung chung cho query trong thang nhan vien
     */
    private function _createBuilderTrongThang(ThuongNhanVien $thuongNhanVien) : Builder
    {
        $thang = $thuongNhanVien->getThangTinhThuong($thuongNhanVien->thangNam);
        $nam = $thuongNhanVien->getNamTinhThuong($thuongNhanVien->thangNam);
        return DonHang::where([
            'id_nhan_vien' => $thuongNhanVien->id_nhan_vien            
            ])
            ->whereIn('trang_thai',[DonHang::TT_DUYET,DonHang::TT_THANH_TOAN,DonHang::TT_DA_XUAT_HET])
            ->whereMonth('ngay_tao_don',$thang)
            ->whereYear('ngay_tao_don',$nam);
    }


    /**
     * dem so don hang trong thang cua nhan vien
     */
    public function soDonHangTrongThang(ThuongNhanVien $thuongNhanVien) : int 
    {
        return $this->_createBuilderTrongThang($thuongNhanVien)->count();
    }

    /**
     * doanh thu tong cong cua thang
     */
    public function tongDoanhThuTrongThang(ThuongNhanVien $thuongNhanVien) : float 
    {
        return $this->_createBuilderTrongThang($thuongNhanVien)->sum('doanh_thu');
    }

    /**
     * don hang trong thang
     */
    public function dsDonHangTrongThang(ThuongNhanvien $thuongNhanVien) : Collection
    {
        return $this->_createBuilderTrongThang($thuongNhanVien)->get();
    }

    /**
     * mo khoa thuong nhan vien
     */
    public function moKhoaThuongThang(ThuongNhanVien $thuongNhanVien) :bool 
    {
        $thuongNhanVien->update([
            'da_nhan_thuong'=>ThuongNhanVien::TT_CHUA_NHAN_THUONG
        ]);

        return true;
    }

    /**
     * khoa thuong thang
     */
    public function khoaThuongThang(ThuongNhanVien $thuongNhanVien) : bool 
    {
        $thuongNhanVien->update([
            'da_nhan_thuong'=>ThuongNhanVien::TT_DA_NHAN_THUONG
        ]);
        
        return true;
    }

    /**
     * cap nhat cac don hang duoc tinh thuong trong thang
     */
    public function capNhatDonHangDuocThuong($thang,$nam,$idNhanVien) :void 
    {
        $dsDonHang = $this->getDsDonHangDuocTinhThuongTheoThangNam($thang,$nam,$idNhanVien);
        $thangNamTinhThuong = DanhMucThangNam::firstOrCreate([
            'thang'=>$thang,
            'nam'=>$nam
            ]);
        $thuongNhanVien = $this->_timHoacThemThuongNhanVien($thangNamTinhThuong->id,$idNhanVien);
        $thuongNhanVien->donHangTinhThuongs()->sync($dsDonHang);
    }

    /**
     * them thuong nhan vien model
     */
    private function _timHoacThemThuongNhanVien($idThangNam,$idNhanVien) : ThuongNhanVien
    {
        $thuongNhanVien = ThuongNhanVien::firstOrCreate([
            'id_thang_nam'=>$idThangNam,
            'id_nhan_vien'=>$idNhanVien
        ],[
            'ngan_sach_thuong' => 0,
            'tong_tien_thuong_dat_duoc' => 0
        ]);
        return $thuongNhanVien;
    }


    /**
     * data cho show thuong ky thuat
     */
    public function showThuongKyThuat(NhanVien $nhanVien, $dsThuongTrongNam, $nam, $dsThuongSanPhamQuanLy, $thuongSanPhamQuanLy) {
        $dsLoaiThuongKyThuat = [];
        $dsMucThuong = [];
        $dsThuongLapDatDaoTao = [];

        //tao builder ca nam
        $dsThuongKyThuatBuilder = $this->_createThuongKyThuatDonHangBuilder(1,$nam,true);

        if($nhanVien->thuocNhomThuongLapDat()) {
            $dsLoaiThuongKyThuat = LoaiThuongKyThuat::dsLoaiKhacMastercam()->get();
            $dsMucThuong = SoTienThuongKyThuat::dsMucThuongKhacMastercam()->dangSuDung()->get();
            $dsThuongKyThuatBuilder->laThuongLapDatHoacGeomagic();
            $dsThuongLapDatDaoTao = $dsThuongKyThuatBuilder->get();
        } else if ($nhanVien->thuocNhomThuongMastercam()) {
            $dsLoaiThuongKyThuat = LoaiThuongKyThuat::dsLoaiMastercam()->get();
            $dsMucThuong = SoTienThuongKyThuat::dsMucThuongMastercam()->dangSuDung()->get();
            $dsThuongKyThuatBuilder->laThuongMastercam();
            $dsThuongLapDatDaoTao = $dsThuongKyThuatBuilder->get();
        }
        return view('run.nhanvien.show-ky-thuat',[
            'nhanVien' => $nhanVien,
            'dsLoaiThuongKyThuat' => $dsLoaiThuongKyThuat,
            'dsMucThuong' => $dsMucThuong,
            'dsThuongTrongNam' => $dsThuongTrongNam,
            'nam' => $nam,
            'dsThuongLapDatDaoTao' => $dsThuongLapDatDaoTao,
            'dsThuongSanPhamQuanLy' => $dsThuongSanPhamQuanLy,
            'thuongSanPhamQuanLy' => $thuongSanPhamQuanLy
            
        ]);
    }

    /**
     * show thuong khoi kinh doanh
     */
    public function showThuongKinhDoanh(NhanVien $nhanVien, $dsThuongTrongNam, $nam, $dsThuongSanPhamQuanLy, $thuongSanPhamQuanLy) {
        $dsDonHangDuocTinh = $nhanVien->dsDonHangDuocTinhTrongNam($nam);
        $tongSoDonhang = $nhanVien->getSoLuongDonHang($dsDonHangDuocTinh);
        $tongDoanhThu = $nhanVien->getTongDoanhThu($dsDonHangDuocTinh);
        $dsDonHang = $nhanVien->donHangs()->whereYear('ngay_tao_don',$nam)->get();
        $thuongNam = ThuongKhoangThoiGian::where([
            'id_nhan_vien'=>$nhanVien->id,
            'nam'=>$nam,
            'loai'=>ThuongKhoangThoiGian::LOAI_THUONG_NAM
        ])->first();

        if($thuongNam!==null){    
            $dsChiTieuNam = $thuongNam->chiTieuCaNhanTheoThoiGian()->with('chiTieu','chiTieu.danhSachCongThuc')->get()->sortBy('chiTieu.thu_tu_sap_xep');
        } else {
            $dsChiTieuNam = null;
        }
        
        return view('run.nhanvien.show-kinh-doanh',[
            'nhanVien' => $nhanVien,
            'tongSoDonHang' => $tongSoDonhang,
            'tongDoanhThu' => $tongDoanhThu,
            'dsThuongTrongNam' => $dsThuongTrongNam,
            'nam' => $nam,
            'dsDonHang' => $dsDonHang,
            'thuongKhoangThoiGian' => $thuongNam,
            'dsChiTieuNam' => $dsChiTieuNam,
            'dsThuongSanPhamQuanLy' => $dsThuongSanPhamQuanLy,
            'thuongSanPhamQuanLy' => $thuongSanPhamQuanLy
        ]);
    }


    /**
     * lay ds thuong ky thuat don hang
     */
    public function getDanhSachThuongKyThuatDonHang($thangNamThuong,$nhanVien) {
        $dsThuongKyThuatDonHang = $this->_createThuongKyThuatDonHangBuilder($thangNamThuong->thang, $thangNamThuong->nam);
        if($nhanVien->laTeamLapDatThietBi()) {
            $dsThuongKyThuatDonHang->laThuongLapDatHoacGeomagic();
        } else {
            $dsThuongKyThuatDonHang->laThuongMastercam();
        }
            
        $dsThuongKyThuatDonHang = $dsThuongKyThuatDonHang->get();
        return $dsThuongKyThuatDonHang;
    }

    /**
     * tao builder thuong ky thuat theo thang
     */
    private function _createThuongKyThuatDonHangBuilder($thang = 1, $nam = 2023, $caNam = false) : Builder
    {
        if(!$caNam) {
            return ThuongKyThuatDonHang::whereHas('donHang',function($query) use ($thang, $nam){
                return $query->whereMonth('ngay_nghiem_thu',$thang)
                            ->whereYear('ngay_nghiem_thu',$nam);
            });
        } else {
            return ThuongKyThuatDonHang::whereHas('donHang',function($query) use ($nam){
                return $query->whereYear('ngay_nghiem_thu',$nam);
            });
        }
        
    }
}