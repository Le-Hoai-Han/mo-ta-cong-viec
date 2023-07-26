<?php 
namespace App\Traits;

use App\Models\DanhMucThangNam;
use App\Models\DonHang\DanhMucSanPham;
use App\Models\DonHang\DonHang;
use App\Models\DonHang\LoaiSanPham;
use App\Models\DonHang\ThanhToanThuocDonHang;
use App\Models\NhanVien;
use App\Models\Thuong\NoXauThuocNhanVien;
use App\Models\Thuong\ThuongNhanVien;
use App\Models\TiLeThuongTheoNhomSP;
use App\Services\Thuong\NoXauService;
use App\Traits\DonHang\DanhSachThanhToan;
use App\Traits\DonHang\TrangThaiDonNoXauTrait;
use App\Traits\KhachHang\ThongTinKhachHang;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait TinhThuongDonHang 
{
    use DanhSachThanhToan;
    use TrangThaiDonNoXauTrait;
    use ThongTinKhachHang;
    
    public function _kiemTraTinhThuongDonHang($donHang) : bool
    {
        if($this->_kiemTraDaNhanThuong($donHang)) {
            return false;
        } 
        /**
         * khong tinh thuong va no xau voi don hang chua duoc duyet
         */
        $donHang->tien_thuong_don_hang = 0;     
        $donHang->duoc_tinh_thuong = DonHang::KHONG_TINH_THUONG;
        $donHang->la_no_xau = DonHang::KHONG_LA_NO_XAU;

        /**
         * khong duyet hoac da huy thi khoi check
         */
        if($donHang->trang_thai == DonHang::TT_DUYET || $donHang->trang_thai == DonHang::TT_THANH_TOAN) {
            //gan bang chua thanh toan roi sau do check
            $donHang->da_thanh_toan = DonHang::CHUA_THANH_TOAN;
           

            $donHang->trang_thai = DonHang::TT_DUYET;
            

        }
        $donHang = $this->capNhatTinhThuongDonHang($donHang);


        
        
        // $donHang->la_no_xau = $this->_thongTinNoXau($donHang);

        $donHang->saveQuietly();
        // dd($donHang);
        
        return true;
        
    }

    /**
     * cap nhat trang thai tinh thuong don hang
     */
    public function capNhatTinhThuongDonHang($donHang) : DonHang
    {
        $donHang->load('thanhToanThuocDonHang');
        $donHang->da_thanh_toan = $this->_capNhatTrangThaiThanhToan($donHang);
        $donHang->la_no_xau = $this->_thongTinNoXau($donHang);
        $donHang->duoc_tinh_thuong = $this->_capNhatDuocTinhThuong($donHang);
        
        
        $tiLeVar = $this->_layCotTiLeThuong($donHang);    
        // ddd($tiLeVar);           
        $this->capNhatTiLeThuongSanPham($donHang,$tiLeVar);
         
        $donHang->tien_thuong_don_hang = $this->_tinhTongTienThuongDonHang($donHang);
        return $donHang;
    }

    /**
     * cap nhat tien thuong cua don hang
     */
    public function capNhatTongTienThuongDonHang($donHang) : void 
    {
        $donHang->tien_thuong_don_hang = $this->_tinhTongTienThuongDonHang($donHang);
        $donHang->save();
    }

    /**
     * Cap nhat tien thuong don hang
     */
    private function _tinhTongTienThuongDonHang(DonHang $donHang) : float
    {
        
        return $donHang->sanPhams()->sum('so_tien_thuong');
    }

    /**
     * Lấy cột tỉ lệ thưởng của sản phẩm dựa theo group hoặc điều kiện trên đơn hàng
     */
    private function _layCotTiLeThuong($donHang) : string
    {
        $nhanVienGroup = $donHang->nhanVien->group;
        
        //neu la don hang thanh ly thi dung ti le thuong thanh ly
        if($donHang->la_don_hang_thanh_ly) {
            return 'ti_le_thuong_thanh_ly';
        }

        //khong phai don hang thanh ly ma thuoc team nao thi dung ti le do
        if($nhanVienGroup == NhanVien::TEAM_BD) {
            return 'ti_le_thuong_bd';
        }

        //neu la sale thi co 2 loai la nguon co san hoac ko 
        if($nhanVienGroup == NhanVien::TEAM_SALE) {
            if($donHang->la_nguon_marketing) {
                return 'ti_le_thuong_sale_nguon_co_san';
            } else {
                return 'ti_le_thuong_sale';
            }
        }

        //thuoc cac nhom con lai thi dung tien thuong dich vu
        return 'tien_thuong_dich_vu';
    }

    /**
     * kiem tra xem phai thuong dich vu khong
     */
    private function _laThuongDichVu($tiLeVar) : bool
    {
        if($tiLeVar == 'tien_thuong_dich_vu') {
            return true;
        }
        return false;
    }

    /**
     * Cập nhât tỉ lệ thưởng cho sản phẩm
     */
    public function capNhatTiLeThuongSanPham($donHang,$tiLeVar) : void
    {
  
            $dsSanPham = $donHang->sanPhams()->with('danhMucSanPham')->get();
            // ddd($dsSanPham);
            foreach($dsSanPham as $sanPham) {
                $tiLeTinhThuong=0;

                $nhomNhanVien=$donHang->nhanVien->nhomNhanVien;
                $loaiSanPham=$sanPham->danhMucSanPham->loaiSanPham;

                // Nếu sản phẩm thuộc Mastercam,khách hàng thuộc nhóm mastercam và mối quan hệ là đại lý thì tỉ lệ thưởng bằng 1%
                $moiQuanHe=$donHang->khachHang->chiTietKhachHang->moiQuanHe;
                $arrIdNhomKH= $donHang->khachHang->chiTietKhachHang->danhSachNhomKH->pluck('id')->toArray();
                $idNhomKHMastercam = config('services.nhom-khach-hang.id_mastercam');
                $idMoiQuanHeDaiLy = config('services.moi-quan-he.id_dai_ly');
                $checkKHMastercam = array_search($idNhomKHMastercam,$arrIdNhomKH);
                if($checkKHMastercam !== false && $moiQuanHe->id == $idMoiQuanHeDaiLy && $loaiSanPham->id == LoaiSanPham::ID_LOAI_MASTERCAM){
                    $tiLeTinhThuong = 1;
                }else{
                    if($nhomNhanVien != null &&  $loaiSanPham){
                        $searchTiLeTinhThuong=TiLeThuongTheoNhomSP::where('id_loai_sp',$loaiSanPham->id)->where('id_nhom_nv',$nhomNhanVien->id)->first();
                        if($searchTiLeTinhThuong){
                            $tiLeTinhThuong =$searchTiLeTinhThuong->ti_le_thuong;
                        }
                    }
                }

                $sanPham->ti_le_thuong = $tiLeTinhThuong;
                // ddd($sanPham->danhMucSanPham->$tiLeVar);
                $sanPham->so_tien_thuong = $sanPham->so_tien_tinh_thuong*$sanPham->ti_le_thuong/100;
                $sanPham->save();
            }
        // }

        
    }

    /**
     * kiem tra don hang da thanh toan du hay chua
     * return bool
     */
    public function kiemTraThanhToanDu($donHang) : bool 
    {
        if ($donHang->_capNhatTrangThaiThanhToan($donHang)== DonHang::DA_THANH_TOAN_DU) {
            return true;
        }
        return false;
    }

    /**
     * kiem tra xem thanh toan moi nhat co thap hon ngay ket thuc tinh thuong khong
     */
    public function kiemTraThanhToanDungHan($donHang) :bool
    {
        // check nếu là đơn hàng dịch vụ thì không tính ngày hạn thanh toán        
        if($this->_laDonHangDichVu($donHang)) {
            return true;
        } 

        if($this->_laDonHangPhanMem($donHang)) {
            return true;
        } 

        // check trong thoi gian tinh thuong
        return $this->_trongThoiHanTinhThuong($donHang);
        
    }
    

    /**
     * kiem tra don hang co phai don dich vu khong
     */
    private function _laDonHangDichVu(DonHang $donHang) : bool 
    {
        $dsSanPhamThuocDonHang = $donHang->sanPhams()->with('danhMucSanPham')->get();
        foreach( $dsSanPhamThuocDonHang as $spThuocDonHang){
            $danhMucSanPham = $spThuocDonHang->danhMucSanPham;
            if($danhMucSanPham != null && !$danhMucSanPham->checkDHDV()){    
                //bat ki cai nao check ra false thi check tiếp xem có phải sản phẩm nguyên vật liệu hay không;
                if($danhMucSanPham->checkSanPhamNguyenVatLieu()== false){
                    // nếu không phải sản phẩm nguyên vật liêu thì check tiếp sản phẩm phụ kiện 
                    if($danhMucSanPham->checkSanPhamPhuKien() == false){
                        return false;
                    }
                }
            }
        }
        return true;
    }

    /**
     * kiem tra don hang co phai don phan mềm khong
     */
    private function _laDonHangPhanMem(DonHang $donHang) : bool 
    {
        $dsSanPhamThuocDonHang = $donHang->sanPhams()->with('danhMucSanPham')->get();
        foreach( $dsSanPhamThuocDonHang as $spThuocDonHang){
            $danhMucSanPham = $spThuocDonHang->danhMucSanPham;
            if($danhMucSanPham != null && !$danhMucSanPham->checkSanPhamPM()){   
                //bat ki cai nao check ra false thi return false;             
                return false;
            }
        }
        return true;
    }

    

    /**
     * kiem tra co thanh toan vượt ngày kết thúc thưởng chưa
     */
    private function _trongThoiHanTinhThuong(DonHang $donHang) : bool
    {
        $thanhToanMoiNhat = $donHang->thanhToanThuocDonHang->last();
        if (strtotime($donHang->ngay_ket_thuc_tinh_thuong) >= strtotime($thanhToanMoiNhat->ngay_thanh_toan)) {
            return true;
        }
        return false;
    }

    /**
     * kiem tra don hang thanh toan chua
     * tra ve trang thai don hang int
     */
    private function _capNhatTrangThaiThanhToan($donHang) : int
    {
        if($donHang->thanhToanThuocDonHang->isNotEmpty()) {
            if($donHang->tongTienThanhToan() >= $donHang->doanh_thu) {
                return DonHang::DA_THANH_TOAN_DU;
            }
            return DonHang::DA_THANH_TOAN_MOT_PHAN;
        }
        return DonHang::CHUA_THANH_TOAN;
    }

    /**
     * cap nhat trang thai thanh toan cua don hang
     * chi cap nhat trang thai, khong cap nhat thong tin khac
     */
    public function capNhatThanhToan($donHang) :void 
    {
        $donHang->update([
            'da_thanh_toan' => $this->_capNhatTrangThaiThanhToan($donHang)
        ]);
        
    }

    /**
     * kiem tra co duoc tinh thuong hay khong
     */
    private function _capNhatDuocTinhThuong($donHang) : int 
    {
        if(($donHang->da_thanh_toan == DonHang::DA_THANH_TOAN_DU) && $this->kiemTraThanhToanDungHan($donHang) && $donHang->la_no_xau==DonHang::KHONG_LA_NO_XAU
        && $this->kiemTraKhachHang($donHang))
        {
            return DonHang::DUOC_TINH_THUONG;
        }
        return DonHang::KHONG_TINH_THUONG;
    }

    /**
     * luu thong tin trang thai duoc tinh thuong
     */
    public function capNhatTrangThaiTinhThuong($donHang) : void 
    {
        $donHang->update([
            'duoc_tinh_thuong'=>$this->_capNhatDuocTinhThuong($donHang)
        ]);
    }


    private function _kiemTraNoXau(DonHang $donHang) : bool 
    {
        if($this->trangThaiDonNoXau($donHang)) {
            $ngayTao = $donHang->ngay_tao_don;

            if(time() > strtotime($ngayTao . ' + '.DonHang::SO_NGAY_NO_XAU.' days') && $donHang->da_thanh_toan !== DonHang::DA_THANH_TOAN_DU) {
                return true;
            }
            
           
            return false;
        }
        return false;
        
    }


    /**
     * lay thong tin no xau cua don hang
     */
    private function _thongTinNoXau(DonHang $donHang) : int
    {
        if($this->_kiemTraNoXau($donHang)) {
            $this->_taoThongTinNoXau($donHang);
            return DonHang::LA_NO_XAU;            
        }
        return DonHang::KHONG_LA_NO_XAU;
    }

    /**
     * khoi tao thong tin no xau khi kiem tra tinh thuong
     */
    private function _taoThongTinNoXau(DonHang $donHang) : void 
    {
        
        if(strtotime($donHang->ngay_tao_don)>=strtotime(NoXauThuocNhanVien::NGAY_BAT_DAU_TINH)) {
            $tienDaThanhToan = $donHang->thanhToanThuocDonHang->sum('so_tien_thanh_toan');
            $tienNo = $donHang->doanh_thu - $tienDaThanhToan;
            $ngayBatDauNoXau = date('Y-m-d',strtotime($donHang->ngay_tao." + ".DonHang::SO_NGAY_NO_XAU));
            
            $noXauService = new NoXauService();
    
            $noXauService->luuNoXau($donHang->id,$donHang->id_nhan_vien,$ngayBatDauNoXau,$tienNo,0);
            
        }
        
    }

    /**
     * cap nhat don hang la no xau
     */
    public function capNhatNoXau(DonHang $donHang) : void 
    {
        if($this->_kiemTraNoXau($donHang)) {
            $donHang->duoc_tinh_thuong = DonHang::KHONG_TINH_THUONG;
            $donHang->la_no_xau = DonHang::LA_NO_XAU;
            $donHang->save();
        }

    }

    public function _kiemTraDaNhanThuong($donHang) : bool 
    {
        $donHang->load('donHangTinhThuongs');

        if($donHang->donHangTinhThuongs->isNotEmpty()) {
            // ddd($donHang->donHangTinhThuongs);
            $thuongNhanVien = $donHang->donHangTinhThuongs()->where('da_nhan_thuong',ThuongNhanVien::TT_DA_NHAN_THUONG)->count();
            
            if($thuongNhanVien > 0) {

                return true;
            }
        }
        return false;
    }
    

    /**
     * don hang duoc tinh thuong trong thang
     */
    public function getDsDonHangDuocTinhThuongTheoThangNam($thang,$nam,$idNhanVien) : ?Collection
    {
        //lay danh sach id don hang duoc tinh thuong
        $dsIDDonHangDuocTinhThuongTheoNhanVien = $this->_getDsIDDonHangDuocTinhThuongTheoNhanVien($idNhanVien);
        //lay thanh toan có ngay thanh toan max theo id don hang
        $dsThanhToanMax = $this->getDsMaxNgayThanhToan($dsIDDonHangDuocTinhThuongTheoNhanVien);
        // dd($dsThanhToanMax->toArray());
        $dsDonThanhToanTrongThang = $this->getDsThanhToanTheoThangNam($thang,$nam, $dsThanhToanMax->pluck('id')->toArray());
        // dd($dsDonThanhToanTrongThang);
        //dung id don hang lam key cho array va chuyen ds ve array
        $dsDonThanhToanTrongThang = $dsDonThanhToanTrongThang->groupBy('id_don_hang')->toArray();
        $dsIDDonHangThanhToanTrongThang = array_keys($dsDonThanhToanTrongThang);
        $dsDonHangDuocTinhThuongCuaNhanVien = DonHang::select('id','doanh_so','doanh_thu','duoc_tinh_thuong','trang_thai','id_nhan_vien','ngay_tao_don','ngay_bat_dau_tinh_thoi_han','ngay_ket_thuc_tinh_thuong','ngay_nghiem_thu','so_ngay_tinh_cong_no','xac_nhan_vat')
            ->whereIn('id',$dsIDDonHangThanhToanTrongThang)
            ->where('duoc_tinh_thuong',DonHang::DUOC_TINH_THUONG)
            ->where('id_nhan_vien',$idNhanVien)
            ->get();
        return $dsDonHangDuocTinhThuongCuaNhanVien;
    }

    public function kiemTraKhachHang($donHang){
        // Kiểm tra id KH nếu lả id không tính thưởng thì return false
        if ($this->checkIDKhachHang($donHang->id_khach_hang)){
            return false;
        }

        return true;
    }
    


    // /**
    //  * don hang thanh toan trong thang
    //  */
    // public function getDsThanhToanTheoThangNam($thang,$nam,$dsThanhToanMax) : ?Collection
    // {
        
    //     $dsThanhToan = ThanhToanThuocDonHang::whereYear('ngay_thanh_toan',$nam)
    //         ->whereMonth('ngay_thanh_toan',$thang)                     
    //         ->whereIn('id',$dsThanhToanMax)
    //         ->orderBy('ngay_thanh_toan','desc')   
    //         ->get();
            
    //     return $dsThanhToan;
    // }

    // /**
    //  * lay ds max ngay thanh toan
    //  */
    // public function getDsMaxNgayThanhToan($dsDonHang) : Collection
    // {
    //     $subMaxThanhToan = ThanhToanThuocDonHang::select(DB::raw('id_don_hang, MAX(ngay_thanh_toan) as max_ngay_thanh_toan'))
    //     ->whereIn('id_don_hang',$dsDonHang)
    //         // ->whereIn('id_don_hang',[21566])
    //         ->groupBy('id_don_hang');
    //         // ->having('ngay_thanh_toan')
            
    //     $dsThanhToanMax = ThanhToanThuocDonHang::select('*')
    //                         ->joinSub($subMaxThanhToan,'max_thanh_toan',function($join){
    //                             $join->on('cms___thanh_toan_thuoc_don_hang.id_don_hang','=','max_thanh_toan.id_don_hang');
    //                             $join->on('cms___thanh_toan_thuoc_don_hang.ngay_thanh_toan','=','max_thanh_toan.max_ngay_thanh_toan');
    //                         })
    //                         ->get();
    //                         return $dsThanhToanMax;
    //                         // dd($dsThanhToanMax);
        
        
    //     // ->get();
        
    // }
    

    private function _getDsIDDonHangDuocTinhThuongTheoNhanVien($idNhanVien) : Array
    {
        return DonHang::select('id')
        ->where('id_nhan_vien',$idNhanVien)
        ->where('duoc_tinh_thuong',DonHang::DUOC_TINH_THUONG)
        ->get()
        ->pluck('id')
        ->toArray();
    }

    
}