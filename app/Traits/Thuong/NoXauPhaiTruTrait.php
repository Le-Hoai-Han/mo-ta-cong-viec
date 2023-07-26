<?php

namespace App\Traits\Thuong;

use App\Models\NhanVien;
use App\Models\Thuong\ChiTietNoXauDaTru;
use App\Models\Thuong\ThuongKhoangThoiGian;
use Illuminate\Database\Eloquent\Collection;

trait NoXauPhaiTruTrait
{
    //ti le no xau con lai
    private $_ti_le_tru_no_xau = 5;
    
    private function _tinhSoTienPhaiTru($noXauPhaiTru) : float
    {
        $soTienCanTru = ($this->_ti_le_tru_no_xau * $noXauPhaiTru->tong_so_tien)/100;
        $soTienNoConLai = $noXauPhaiTru->tien_con_lai;
        return min($soTienCanTru,$soTienNoConLai);
    }


    /**
     * tinh tong so tien no xau phai tru de luu vao thuong khoang thoi gian
     */
    public function tinhNoXauPhaiTru(NhanVien $nhanVien) : float
    {
        $dsNoXauPhaiTru = $this->_dsNoXauPhaiTru($nhanVien);
        $tongNoXauCanTru = 0;
        if($dsNoXauPhaiTru->isNotEmpty()) {
            foreach($dsNoXauPhaiTru as $noXauPhaiTru) {
            
               
                $tongNoXauCanTru += $this->_tinhSoTienPhaiTru($noXauPhaiTru);
                // echo "Tổng: ".$noXauPhaiTru->tong_so_tien." Trừ: ".$soTienCanTru." Số tiền còn lại: ". $soTienNoConLai."\n";
            }
        }
        
        return round($tongNoXauCanTru,2);
    }

    /**
     * ds no xau phai tru cua nhan vien
     * tien can tra con lai >0
     */
    protected function _dsNoXauPhaiTru(NhanVien $nhanVien) : Collection
    {
        return $nhanVien->noXauThuocNhanVien()->where([
                ['tien_con_lai','<>',0]
            ])->get();
    }

    /**
     * lay tong no xau phai tru
     */
    public function getTongNoXauPhaiTru($nhanVien) : float 
    {
        $dsNoXauPhaiTru = $this->_dsNoXauPhaiTru($nhanVien);
        return $dsNoXauPhaiTru->sum('tong_so_tien');
    }

    /**
     * luu danh sach chi tiet no xau da tru vao phan ChiTietNoXauDaTru 
     */
    protected function _luuNoXauDaTruThuocThuongNam(ThuongKhoangThoiGian $thuongKhoangThoiGian) : void 
    {
        if($thuongKhoangThoiGian->loai == ThuongKhoangThoiGian::LOAI_THUONG_NAM) {
            $dsNoXauPhaiTru = $this->_dsNoXauPhaiTru($thuongKhoangThoiGian->nhanVien);
            foreach($dsNoXauPhaiTru as $noXauPhaiTru) {

                $this->_luuChiTietTruNoTheoThuongNam($thuongKhoangThoiGian->id,$noXauPhaiTru->id,$this->_tinhSoTienPhaiTru($noXauPhaiTru),$thuongKhoangThoiGian->ngay_khoa_phat_thuong);
            }
        }
    }

    /**
     * xoa no xau da tru cua thuong nam khi mo khoa
     */
    protected function _xoaNoXauDaTruThuocThuongNam(ThuongKhoangThoiGian $thuongKhoangThoiGian) : void 
    {
        if($thuongKhoangThoiGian->loai == ThuongKhoangThoiGian::LOAI_THUONG_NAM) {
            foreach($thuongKhoangThoiGian->noXauDaTru as $chiTietNoXauDaTru) {
                $noXau = $chiTietNoXauDaTru->noXau;
                $chiTietNoXauDaTru->delete();
                $noXau->capNhatTienNo();
            }
        }
    }

    /**
     * luu thong tin chi tiet no da tru
     */
    private function _luuChiTietTruNoTheoThuongNam($idThuong,$idNoXau,$soTienDaTru,$ngayLuu) : void 
    {
        $chiTietNoXauDaTru = ChiTietNoXauDaTru::firstOrNew([
            'id_thuong_thoi_gian'=>$idThuong,
            'id_no_xau'=>$idNoXau
        ]);
        $chiTietNoXauDaTru->ngay_tru_no = $ngayLuu;
        $chiTietNoXauDaTru->so_tien = $soTienDaTru;
        $chiTietNoXauDaTru->save();
    }

}