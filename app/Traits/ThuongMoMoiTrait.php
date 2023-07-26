<?php

namespace App\Traits;

use App\Models\DanhMucThangNam;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\DonHangDauTien;
use App\Models\NhanVien;
use App\Models\Thuong\DonHangThuongMoMoi;
use App\Models\Thuong\SanPhamThuongMoMoi;
use App\Models\Thuong\ThuongMoMoi;
use App\Models\Thuong\TMMDonHangKhachHang;
use App\Models\Thuong\TiLeThuongMoMoi;
use App\Traits\KhachHang\ThongTinKhachHang;

trait ThuongMoMoiTrait
{
    use TinhThuongDonHang;
    public function createThuongMoMoiKhachHangDonHang($donHang)
    {
       // Tìm ra đơn hàng đầu tiên của khách hàng

        // Nếu đơn hàng đầu tiên đã thanh toán đủ(thành công) và giá trị đơn hàng lớn hơn không thì sẽ lưu vào bảng
        $getDonHangDauTien = $donHang->layDonHangDauTienDeLuu();

        // Lưu đơn hàng đầu tiên vào bảng tmm_don_hang_dau_tien
        $loadDonHangDauTien = $this->__LoadDonHangDauTien($donHang->id);
        if($loadDonHangDauTien == null){
            DonHangDauTien::create([
                'id_don_hang' => $donHang->id,
                'id_don_hang_dau_tien' => $getDonHangDauTien->id
            ]);
        }else{
            $loadDonHangDauTien->update(['id_don_hang_dau_tien' => $getDonHangDauTien->id]);
        }

        $donHangDauTien= $donHang->donHangDauTien->donHang;

        // lấy mối quan hệ từ khách hàng
        $moiQuanHe = $donHangDauTien->khachHang->chiTietKhachHang->moiQuanHe;

        // check ID mối quan hệ xem có rơi vào list Id không được tính thưởng mở mới không?
        $checkMoiQuanHe = $this->checkIDMoiQuanHe($moiQuanHe->id);

        // check xem khách hàng có nằm trong list không được tính thưởng (tiki,shopee,lazada)
        $checkKhachHang = $this->kiemTraKhachHang($donHangDauTien);
        // Tạo array thương mở mới
        $arrThuongMoMoi=[
            'id_khach_hang'=>$donHangDauTien->id_khach_hang,
            'id_don_hang_dau_tien'=> $donHangDauTien->id,
            'ngay_bat_dau'=>$donHangDauTien->ngay_tao_don,
            'id_nhan_vien'=>$donHang->id_nhan_vien,
            'trang_thai' => ( $checkMoiQuanHe == false && $checkKhachHang   ?  true : false)
        ];

        if($this->loadKhachHangMoMoi($donHangDauTien->id_khach_hang) == null){
            // Lưu vào bảng thưởng mở mới 
            $donHangThuongMoMoi=TMMDonHangKhachHang::create($arrThuongMoMoi);
        }else{
            $donHangThuongMoMoi =$this->loadKhachHangMoMoi($donHangDauTien->id_khach_hang);
            $donHangThuongMoMoi->update($arrThuongMoMoi);
        }
        foreach($donHang->khachHang->listDonHang as $donHang){

            if($donHang->layDonHangDauTienDeLuu()->ngay_tao_don < now()->subMonths(6)){
                break;
            }
            foreach($donHang->sanPhams as $sanPham){
            
                //Tìm ra id loại sản phẩm để tìm phần % tỉ lệ thưởng 
                $idLoaiSanPham=$sanPham->danhMucSanPham->loaiSanPham->id;
    
                // Tìm tỉ lệ thưởng trong bảng cms___ti_le_thuong_mo_moi
                $reCoreTiLeThuong=TiLeThuongMoMoi::where([
                    ['id_loai_san_pham','=',$idLoaiSanPham],
                    ['mo_ta','=',TiLeThuongMoMoi::TT_DANG_SU_DUNG]
                ])->first();
    
                // Nếu recordTiLeThuong == null thi ti le thưởng = 0
                $tiLeThuong = 0;
                if($reCoreTiLeThuong != null){
                    $tiLeThuong=$reCoreTiLeThuong->ti_le_thuong;
                }
    
                // Tạo mảng để create record trong bảng sản phẩm thuộc mở mới
                $arrSPThuocMoMoi=[
                    'id_don_hang'=>$donHang->id,
                    'ti_le_thuong'=> $tiLeThuong,
                    'so_luong'=>$sanPham->so_luong,
                    'gia_san_pham'=>$sanPham->gia_san_pham,
                    'id_danh_muc_san_pham'=>$sanPham->danhMucSanPham->id
                ];

                $attributes=[
                    'id_don_hang'=>$donHang->id,
                    'gia_san_pham'=>$sanPham->gia_san_pham,
                    'id_danh_muc_san_pham'=>$sanPham->danhMucSanPham->id
                ];
                
                SanPhamThuongMoMoi::updateOrCreate( $attributes,$arrSPThuocMoMoi);
            }
        
    }
       
    }


    public function checkIDMoiQuanHe($IDMoiQuanHe){
        $reg="/".config('services.moi-quan-he.id_khong_tinh_thuong_mo_moi')."/i";
        return preg_match($reg,$IDMoiQuanHe);
    }


    public function listDonHangThuongMoMoi($thuongNhanVien){
        $thangNamThuong = $thuongNhanVien->thangNam;
        $thangNamBDThuongMoMoi= $this->__getThangNamBDThuongMoMoi();
        $thoiGianThuongHienTai=date('Y-m-%',strtotime( $thangNamThuong->nam.'-'. $thangNamThuong->thang));
        $dsDonHangThuongMoMoi=DonHangThuongMoMoi::whereHas('TMMDonHangKhachHang',function($query) use ( $thoiGianThuongHienTai){
            $query->where('ngay_ket_thuc','>=', $thoiGianThuongHienTai);
        })->whereHas('donHang',function($query) use ( $thuongNhanVien){
            $query->where('id_nhan_vien', $thuongNhanVien->id_nhan_vien);
        })->where('ngay_thanh_toan_du','like',$thoiGianThuongHienTai)
        ->where('ngay_thanh_toan_du','>=', $thangNamBDThuongMoMoi)
        ->with('donHang','TMMDonHangKhachHang')
        ->get();
        return $dsDonHangThuongMoMoi;
    }

    public function listDonHangCoHoiThuongMoMoi($thuongNhanVien) 
    {
        $thoiGianHienTai = $this->__getThangNamHienTai();
        $listIdDonHangMoMoi = $this->listDonHangThuongMoMoi($thuongNhanVien)->pluck('id_don_hang');
        $listIdTTDonHangMoMoiDuocThuong =DonHangThuongMoMoi::select('id_don_hang')->get()->pluck('id_don_hang');
        $listIdDonHangTTCuaThangTruoc=DonHang::where('da_thanh_toan',DonHang::DA_THANH_TOAN_DU)
        ->whereHas('thanhToanThuocDonHang',function($query) use ($thoiGianHienTai){
            $query->where('ngay_thanh_toan','<',$thoiGianHienTai);
        })->pluck('id');
        
        $dsDonHangCoHoiTMM=DonHang::where([
            ['id_nhan_vien',$thuongNhanVien->id_nhan_vien],
            ['trang_thai','!=',DonHang::TT_HUY],
            ['doanh_thu','>',0],
            ['la_no_xau','!=',DonHang::LA_NO_XAU]])
            ->whereNotIn('id',$listIdDonHangTTCuaThangTruoc)
            ->whereHas('khachHang',function($q){
                $q->whereHas('TMMDonHangKhachHang',function($q1){
                    $q1->where('ngay_ket_thuc','>=',date('Y-m-d'));
                    $q1->where('trang_thai',TMMDonHangKhachHang::TT_DUOC_TINH_THUONG);
                });
            })
                ->whereNotIn('id',$listIdDonHangMoMoi)
                ->whereNotIn('id', $listIdTTDonHangMoMoiDuocThuong)
                ->with('thanhToanThuocDonHang')
                ->get();
            
        return $dsDonHangCoHoiTMM;
    }

    public function loadThuongMoMoi($idNhanVien,$idThangNam){
        return DonHangThuongMoMoi::where([
            ['id_nhan_vien',$idNhanVien],
            ['id_thang_nam',$idThangNam],
        ])->first();
    }

    public function __LoadDonHangDauTien($idDonHang){
        return DonHangDauTien::where('id_don_hang',$idDonHang)->first();
    }
    
    public function __idThangNamBDThuongMoMoi(){
        $idThangNamBDThuongMoMoi=config('services.thuong-mo-moi.id_thang_nam_bat_dau');
        if(is_numeric( $idThangNamBDThuongMoMoi)){
            return  $idThangNamBDThuongMoMoi;
        }
        
        return null;
    }

    public function __getThangNamHienTai(){
        $thoiGianHienTai = date('Y-m-%');
        if(date('d') <= 5){
            $thoiGianHienTai = date('Y-m-%',strtotime( '-1 month'));
        }
        return $thoiGianHienTai;
    }

    public function __getThangNamBDThuongMoMoi(){
        $idThangNamBDThuongMoMoi=$this->__idThangNamBDThuongMoMoi();
        $thangNamBDThuongMoMoi=DanhMucThangNam::find($idThangNamBDThuongMoMoi);
        $thoiGianBDThuongMoMoi=date('Y-m-%',strtotime( $thangNamBDThuongMoMoi->nam.'-'. $thangNamBDThuongMoMoi->thang));
        return $thoiGianBDThuongMoMoi;
    }

    public function __getDanhMucThangNam($ngayThang){
        $thang=date('m',strtotime($ngayThang));
        $nam=date('Y',strtotime($ngayThang));
        $danhMucThangNam = DanhMucThangNam::where([
            ['thang', $thang],
            ['nam', $nam]
        ])->first();

        return $danhMucThangNam;
    }

    public function __tienThuongMoMoiCaNhan($thuong,$nhanVien,$str){
        $idThangNamBatDau=$this-> __idThangNamBDThuongMoMoi();
        if($str == 'thang'){
            $tienThuongMoMoiCaNhan=$nhanVien->thuongMoMoi->where('id_thang_nam','>=',$idThangNamBatDau)->where('id_thang_nam',$thuong->id_thang_nam)->sum('so_tien_thuong_mo_moi');
        }
        if($str == 'nam'){
            $nam=$thuong->nam;
            $listIdThangNam=DanhMucThangNam::where('nam',$nam)->pluck('id');
            $tienThuongMoMoiCaNhan=$nhanVien->thuongMoMoi->where('id_thang_nam','>=',$idThangNamBatDau)->whereIn('id_thang_nam', $listIdThangNam)->sum('so_tien_thuong_mo_moi');
        }
        return $tienThuongMoMoiCaNhan;
    }

    public function __tienThuongMoMoiCuaCaTeam($thuong,$nhanVien,$str){
        $listNhanVienThuocTeam=$nhanVien->nhomNhanVien->nhanVienThuocNhom()->whereNotIn('id',[$nhanVien->id])->where('da_xoa',NhanVien::TT_KO_XOA)->get();
        $tongTienThuongMoMoiCuaTeam=0;
        if($nhanVien->laQuanLy()){
            foreach($listNhanVienThuocTeam as $nhanVien){
                $tongTienThuongMoMoiCuaTeam += $this-> __tienThuongMoMoiCaNhan($thuong,$nhanVien,$str);;
            }
        }
        return $tongTienThuongMoMoiCuaTeam;
    }

}
