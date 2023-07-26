<?php

namespace App\Traits\Thuong;

use App\Models\CongThuc\ChiTieuCaNhanThoiGian;
use App\Models\DonHang\DonHang;
use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Traits\CongThucThuongThoiGianTrait;
use App\Traits\DonHang\DanhSachThanhToan;
use App\Traits\DonHang\DonHangThanhToanDuNhanVien;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

trait ThuongNamTrait
{
    use CongThucThuongThoiGianTrait;
    use DonHangThanhToanDuNhanVien;
    use DanhSachThanhToan;
    use NoXauPhaiTruTrait;

    /**
     * luu thuong theo thoi gian cho danh sach chi tieu va danh sach nhan vien
     */
    public function luuThongTinThuongNam(array $dsNhanVien,array $dsChiTieu,int $nam) : void
    {
        $idNguoiCapNhat = auth()->user()->id;
        foreach($dsNhanVien as $index=>$idNhanVien) {
            $this->luuThongTinThuongNamNhanVien($idNhanVien,$dsChiTieu,$nam);
        }
        
    }

    /**
     * luu thong tin thuong nam 1 nhan vien
     */
    public function luuThongTinThuongNamNhanVien(int $idNhanVien, array $dsChiTieu,int $nam) : void 
    {
        $thuongNam = ThuongKhoangThoiGian::firstOrNew([
            'id_nhan_vien'=>$idNhanVien,
            'nam'=>$nam,
            'thang_bat_dau'=>1,
            'thang_ket_thuc'=>12,
            'loai'=>ThuongKhoangThoiGian::LOAI_THUONG_NAM
        ]);
        // dd($thuongTheoThoiGian);

        if($thuongNam->save()) {
           
            $this->capNhatChiTieuThuongNam($thuongNam, $dsChiTieu);
            $this->luuCongThucThuongThoiGian($thuongNam);
        }
    }

    /**
     * cap nhat chi tieu thuong nam tu chi tieu thuong quy
     */
    public function capNhatChiTieuThuongNam(ThuongKhoangThoiGian $thuongNamNhanVien,$dsChiTieu) : void 
    {   
        
        $dsThuongThoiGianTrongNam = $this->getDsThuongQuyTheoNamCuaNhanVien($thuongNamNhanVien->nam,$thuongNamNhanVien->id_nhan_vien);
        $dsIDThuong = $this->getDanhSachIDThuongThoiGian($dsThuongThoiGianTrongNam);

        $dsTongChiTieu = $this->getDsChiTieuThoiGianNam($dsIDThuong,$dsChiTieu);
        foreach($dsTongChiTieu as $tongChiTieu) {
            $chiTieuThoiGian = ChiTieuCaNhanThoiGian::firstOrNew([
                'id_thuong_thoi_gian'=>$thuongNamNhanVien->id,
                'id_chi_tieu'=>$tongChiTieu->id_chi_tieu
            ],[
                'ti_le_dat_duoc'=>0
            ]);
            $chiTieuThoiGian->ket_qua = $tongChiTieu->tong_ket_qua;
            $chiTieuThoiGian->muc_tieu = $tongChiTieu->tong_muc_tieu;
            $chiTieuThoiGian->save();
        }
    }

    /**
     * lay danh sach ID cua thuong thoi gian trong nam de xu ly
     */
    protected function getDanhSachIDThuongThoiGian($dsThuongThoiGian) : array 
    {
        if($dsThuongThoiGian->isNotEmpty()) {
            return $dsThuongThoiGian->pluck('id')->toArray();
        }
        
        //mãng rỗng thì trả về 0
        return [0];
        
    }

    /**
     * lay danh sach thuong quy
     */
    protected function getDsThuongQuyTheoNamCuaNhanVien($nam,$idNhanVien) : ?Collection
    {
        $dsThuongThoiGianTrongNam = ThuongKhoangThoiGian::where('nam',$nam)->where('id_nhan_vien',$idNhanVien)->get();
        return $dsThuongThoiGianTrongNam;
    }

    /**
     * lay danh sach tong chi tieu theo quy cua nam dang tinh
     */
    protected function getDsChiTieuThoiGianNam(array $dsThuongThoiGianID,array $dsChiTieu) 
    {
        $dsChiTieuThoiGian = ChiTieuCaNhanThoiGian::whereIn('id_chi_tieu',array_keys($dsChiTieu))->whereIn('id_thuong_thoi_gian',$dsThuongThoiGianID)->selectRaw('id_chi_tieu, SUM(muc_tieu) as tong_muc_tieu, SUM(ket_qua) as tong_ket_qua')->groupBy('id_chi_tieu')->get();
        return $dsChiTieuThoiGian;
    }

    /**
     * action column cho thuong nam
     */
    private function createActionThuongNamColumns($thuongNam) : string
    {
        $actionColumn = "<a href='" . route('thuong-nam.show', $thuongNam) . "'><span class='material-icons text-info'>preview</span></a>";
        $user = auth()->user();
        if ($user->can('edit_thuongnhanvien')) {
            if($thuongNam->daKhoa()) {
                $actionColumn .= "<a href='" . route('thuong-nam.khoa-thuong', ['thuongKhoangThoiGian' => $thuongNam,'trangThai'=>'khoa']) . "' title='Nhấn để khóa tính thưởng'><span class='material-icons text-info'>lock_open</span></a>";
            } else {
                $actionColumn .= "<a href='" . route('thuong-nam.khoa-thuong', ['thuongKhoangThoiGian' => $thuongNam,'trangThai'=>'mo-khoa']) . "' title='Đã khóa. Nhấn để mở khóa'><span class='material-icons text-warning'>lock</span></a>";
            }
        }
        if($user->can('delete_thuongnhanvien')) {           
            $actionColumn .= "<a href='#' onclick='setDeleteUrl(\"" . url(route('thuong-nam.destroy',  ['thuongNam' => $thuongNam])) . "\")' ><span class='material-icons text-danger'>delete</span></a>";
            return  $actionColumn;
        }
        
        return $actionColumn;
    }

    /**
     * tinh ngan sach thuong nam và luu vào db
     */
    public function tinhNganSachThuongNam(ThuongKhoangThoiGian $thuongNam) : void 
    {
        $thuongNam->tong_ngan_sach_thuong = $this->_layNganSachThuongNam($thuongNam);
        $thuongNam->save();
       
    }

    /**
     * tinh tong Ngan Sach Thuong Nam
     * 
     */
    protected function _layNganSachThuongNam(ThuongKhoangThoiGian $thuongNam) : float 
    {
        $this->capNhatDonHangThuongNam($thuongNam);
        // Lấy 40% ngân sách thưởng của team (nếu có)
        $tongNganSachThuongCuaTeam = 0;
        if($thuongNam->nhanVien->laQuanLy()){
            $tongNganSachThuongCuaTeam=$thuongNam->nhanVien->getTongNganSachThuongCuaTeam();
        }
        $nganSachThuongNam = $thuongNam->donHangThuongNams->sum('tien_thuong_don_hang') +  $tongNganSachThuongCuaTeam *0.4;
        return  $nganSachThuongNam;
    }

    /**
     * cap nhat don hang thuong nam
     */
    public function capNhatDonHangThuongNam(ThuongKhoangThoiGian $thuongNam) : void 
    {
        $dsDonHangNhanVien = $this->getDsDonHangNhanVien($thuongNam->id_nhan_vien);
        $dsThanhToanMax = $this->getDsMaxNgayThanhToan($dsDonHangNhanVien);
        if($dsThanhToanMax->isNotEmpty()) {
            $dsThanhToanTrongNam = $this->getDsThanhToanTheoNam($thuongNam->nam,$dsThanhToanMax->pluck('id')->toArray());
            
            if($dsThanhToanTrongNam->isNotEmpty()) {
                $dsDonHangID = $dsThanhToanTrongNam->pluck('id_don_hang')->toArray();
                // dd($dsDonHangID);
                $thuongNam->donHangThuongNams()->sync($dsDonHangID);
            }  
        }
    }

    /**
     * tinh tien thuong da nhan trong nam
     */
    protected function _layTienThuongDaNhanTrongNam(ThuongKhoangThoiGian $thuongNam) : float 
    {
        $dsThuongQuy = ThuongKhoangThoiGian::where([
            'id_nhan_vien'=>$thuongNam->id_nhan_vien,
            'nam'=>$thuongNam->nam,
            'loai'=>ThuongKhoangThoiGian::LOAI_THUONG_QUY
        ])->get();

        if($dsThuongQuy->isEmpty()) {
            return 0;
        }
        $tienThuongDaNhan = $dsThuongQuy->sum('tong_tien_thuong_da_nhan');
        return $tienThuongDaNhan;
    }


}