<?php 
namespace App\Services\Thuong;

use App\Models\CongThuc\ChiTieuCaNhanThoiGian;
use App\Models\CongThuc\CongThucThuongThoiGian;
use App\Models\CongThuc\CongThucTinh;
use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Traits\CongThucThuongThoiGianTrait;
use App\Traits\Thuong\NoXauPhaiTruTrait;
use App\Traits\Thuong\ThuongNamTrait;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ThuongThoiGianService
{
    use ThuongNamTrait;
    use CongThucThuongThoiGianTrait;
    use NoXauPhaiTruTrait;
    
    /**
     * luu thuong theo thoi gian cho danh sach chi tieu va danh sach nhan vien
     */
    public function luuThongTinThuongTheoThoiGian(array $dsNhanVien,array $dsChiTieu,int $nam, int $quy) : void
    {
        $dsThang = ThuongKhoangThoiGian::thangBatDauKetThucThuocQuy($quy);
        $idNguoiCapNhat = auth()->user()->id;
        foreach($dsNhanVien as $index=>$idNhanVien) {
            $this->luuThuongThoiGianNhanVien($idNhanVien,$dsThang[0],$dsThang[1],$nam,$dsChiTieu,$idNguoiCapNhat);
           
        }
        // $this->luuThongTinThuongNam($dsNhanVien,$dsChiTieu,$nam);
        
    }


    
    /**
     *  luu thuong thoi gian cho 1 nhan vien 
     */
    public function luuThuongThoiGianNhanVien(int $idNhanVien,int $thangBatDau,int $thangKetThuc,int $nam, array $dsChiTieu, int $idNguoiCapNhat) : ThuongKhoangThoiGian 
    {
        
        $thuongTheoThoiGian = ThuongKhoangThoiGian::firstOrNew([
            'id_nhan_vien'=>$idNhanVien,
            'nam'=>$nam,
            'thang_bat_dau'=>$thangBatDau,
            'thang_ket_thuc'=>$thangKetThuc
        ]);
        // dd($thuongTheoThoiGian);

        if($thuongTheoThoiGian->save()) {
            $this->luuDSChiTieuTheoKhoangThoiGian($thuongTheoThoiGian->id,$dsChiTieu,$idNguoiCapNhat);
            $this->luuCongThucThuongThoiGian($thuongTheoThoiGian);
            $this->luuThongTinThuongNamNhanVien($idNhanVien,$dsChiTieu,$nam);
        }
        
        return $thuongTheoThoiGian;
    }

    /**
     * luu chi tieu nam cho nhan vien
     */
    public function luuDSChiTieuTheoKhoangThoiGian(int $idthuongTheoThoiGian,array $dsChiTieu,int $idNguoiCapNhat) : void 
    {
        foreach($dsChiTieu as $idChiTieu=>$mucTieu) {
            $this->luuChiTieuThoiGian($idthuongTheoThoiGian,$idChiTieu,$mucTieu,$idNguoiCapNhat);
        }
        
    }

    /**
     * luu từng chỉ tiêu 
     */
    public function luuChiTieuThoiGian(int $idThuongTheoThoiGian, int $idChiTieu, float $mucTieu, int $idNguoiCapNhat)
    {
        $chiTieuThoiGian = ChiTieuCaNhanThoiGian::firstOrNew([
            'id_thuong_thoi_gian'=>$idThuongTheoThoiGian,
            'id_chi_tieu'=>$idChiTieu
        ],[
            'ket_qua'=>0
        ]);   

        $chiTieuThoiGian->muc_tieu = $mucTieu;
        $chiTieuThoiGian->id_nguoi_cap_nhat = $idNguoiCapNhat;
        
        return $chiTieuThoiGian->save();
    }

    

    /**
     * cap nhat khoa thuong thoi gian
     */
    public function khoaThuong(ThuongKhoangThoiGian $thuongKhoangThoiGian) : void 
    {
        $thuongKhoangThoiGian->ngay_khoa_phat_thuong = date('Y-m-d');
        $this->_luuNoXauDaTruThuocThuongNam($thuongKhoangThoiGian);
        $thuongKhoangThoiGian->saveQuietly();
        
    }

    /**
     * cap nhat mo khoa thuong
     */
    public function moKhoaThuong(ThuongKhoangThoiGian $thuongKhoangThoiGian) : void 
    {
        $thuongKhoangThoiGian->ngay_khoa_phat_thuong = null;
        $this->_xoaNoXauDaTruThuocThuongNam($thuongKhoangThoiGian);
        $thuongKhoangThoiGian->saveQuietly();
    }

    /**
     * tinh ngan sach thuong quy
     */
    public function tinhTienThuong(ThuongKhoangThoiGian $thuongKhoangThoiGian) : ThuongKhoangThoiGian 
    {
        // dd($thuongKhoangThoiGian);
        
        if($thuongKhoangThoiGian->loai == ThuongKhoangThoiGian::LOAI_THUONG_QUY) {
            $tienThuongNhanVien = $thuongKhoangThoiGian->thongTinTienThuongThoiGian();
            $thuongKhoangThoiGian->tong_ngan_sach_thuong = $tienThuongNhanVien['tong_ngan_sach_thuong'];
            $thuongKhoangThoiGian->tong_tien_thuong_da_nhan = $tienThuongNhanVien['tong_tien_thuong_da_nhan'];
        } else {
            $dsThuongQuy = ThuongKhoangThoiGian::where([
                'id_nhan_vien'=>$thuongKhoangThoiGian->id_nhan_vien,
                'nam'=>$thuongKhoangThoiGian->nam,
                'loai'=>ThuongKhoangThoiGian::LOAI_THUONG_QUY
            ])->get();
            foreach($dsThuongQuy as $thuongThoiGianQuy) {
                $this->tinhTienThuong($thuongThoiGianQuy);
            }
            
            //#thuong nam
            $thuongKhoangThoiGian->tong_ngan_sach_thuong = $this->_layNganSachThuongNam($thuongKhoangThoiGian);
            $thuongKhoangThoiGian->tong_tien_thuong_da_nhan = $this->_layTienThuongDaNhanTrongNam($thuongKhoangThoiGian);
        }
        
        
        $thuongKhoangThoiGian->save();
        return $thuongKhoangThoiGian;
    }

    /**
     * cap nhat thong tin cac chi tieu cong don thuoc thoi gian thuong nay
     */
    public function capNhatChiTieuCongDon(ThuongKhoangThoiGian $thuongKhoangThoiGian) : void 
    {
        
        $thuongKhoangThoiGian->capNhatChiTieuThuong();    
    }

    /**
     * tinh ket qua tu cong thuc theo thoi gian
     */
    public function tinhKetQuaCongThuc(ThuongKhoangThoiGian $thuongKhoangThoiGian) : ThuongKhoangThoiGian {
        $congthucThoiGian = $thuongKhoangThoiGian->congThucThuongTheoThoiGian->filter(function($congthucThoiGian) {
            return $congthucThoiGian->congThucTinh->loai == CongThucTinh::LOAICT_CHINH;
        })->first();
        $congthucThoiGian->tinhKetQua();
        $thuongKhoangThoiGian->refresh();
        
        return $thuongKhoangThoiGian;
    }

    public function tinhTienThuongConlai(ThuongKhoangThoiGian $thuongKhoangThoiGian) : ThuongKhoangThoiGian 
    {
        if($thuongKhoangThoiGian->loai == ThuongKhoangThoiGian::LOAI_THUONG_NAM) {
            $thuongKhoangThoiGian->tong_no_xau_phai_tru = $this->getTongNoXauPhaiTru($thuongKhoangThoiGian->nhanVien);
            $thuongKhoangThoiGian->tien_no_xau_phai_tru = $this->tinhNoXauPhaiTru($thuongKhoangThoiGian->nhanVien);
            
        } else {
            $thuongKhoangThoiGian->tien_no_xau_phai_tru = 0;
        }
        $thuongKhoangThoiGian->tien_thuong_con_lai = $thuongKhoangThoiGian->tong_tien_thuong_dat_duoc - ($thuongKhoangThoiGian->tong_tien_thuong_da_nhan + $thuongKhoangThoiGian->tien_no_xau_phai_tru);
        $thuongKhoangThoiGian->save();

        return $thuongKhoangThoiGian;
    }

    

    /**
     * tao data table de dung cho da thuong thoi gian va thuong nam
     * 
     */
    public function createDataTable($dsThuongThoiGian) 
    {
        return DataTables::of($dsThuongThoiGian)
            ->addColumn('ten_nhan_vien', function ($thuong) {
                return $thuong->nhanVien->ho_ten;
            }) 
            ->addColumn('quy', function ($thuong) {
                return $thuong->quy;
            })          
            ->editColumn('ngan_sach_thuong',function($thuong){
                return thuGonSoLe($thuong->ngan_sach_thuong);
            })         
            ->addColumn('actions', function ($thuong) {
                if($thuong->loai==ThuongKhoangThoiGian::LOAI_THUONG_NAM) {
                    return $this->createActionThuongNamColumns($thuong);
                }
                return $this->createActionThuongQuyColumns($thuong);
            })
            ->rawColumns(['actions','da_nhan_thuong'])
            ->make(true);
    }

    
    /**
     * action column cho thuong nam
     */
    private function createActionThuongQuyColumns($thuongThoiGian) : string
    {
        $actionColumn = "<a href='" . route('thuong-thoi-gian.show', $thuongThoiGian) . "'><span class='material-icons text-info'>preview</span></a>";
        $user = auth()->user();
        if ($user->can('edit_thuongnhanvien')) {
            if($thuongThoiGian->daKhoa()) {
                $actionColumn .= "<a href='" . route('thuong-thoi-gian.khoa-thuong', ['thuongKhoangThoiGian' => $thuongThoiGian,'trangThai'=>'mo-khoa']) . "' title='Mở khóa tính thưởng'><span class='material-icons text-info'>lock_open</span></a>";
            } else {
                $actionColumn .= "<a href='" . route('thuong-thoi-gian.khoa-thuong', ['thuongKhoangThoiGian' => $thuongThoiGian,'trangThai'=>'khoa']) . "' title='Đã nhận thưởng. Khóa tính thưởng'><span class='material-icons text-info'>credit_score</span></a>";
            }
        }
        if($user->can('delete_thuongnhanvien')) {
            $actionColumn .= "<a href='#' onclick='setDeleteUrl(\"" . url(route('thuong-thoi-gian.destroy',  ['thuongKhoangThoiGian' => $thuongThoiGian])) . "\")' ><span class='material-icons text-danger'>delete</span></a>";
            return  $actionColumn;
        }
        
        return $actionColumn;
    }

}