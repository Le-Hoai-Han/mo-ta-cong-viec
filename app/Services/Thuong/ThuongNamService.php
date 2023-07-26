<?php 
namespace App\Services\Thuong;

use App\Models\CongThuc\ChiTieuCaNhanTheoNam;
use App\Models\Thuong\ThuongNamNhanVien;

class ThuongNamService
{
    public function luuThongTinThuongNam(array $dsNhanVien,array $dsChiTieu,int $nam) : void
    {
        foreach($dsNhanVien as $index=>$idNhanVien) {
            $thuongNam = ThuongNamNhanVien::firstOrNew([
                'id_nhan_vien'=>$idNhanVien,
                'nam'=>$nam
            ]);

            if($thuongNam->save()) {
                $this->_luuChiTieuNamNhanVien($thuongNam->id,$dsChiTieu);
            }

        }
        
    }

    /**
     * luu chi tieu nam cho nhan vien
     */
    private function _luuChiTieuNamNhanVien($idThuongNam,$dsChiTieu) : void 
    {
        foreach($dsChiTieu as $idChiTieu=>$mucTieu) {
            $chiTieuNam = ChiTieuCaNhanTheoNam::firstOrNew([
                'id_thuong_nam'=>$idThuongNam,
                'id_chi_tieu'=>$idChiTieu
            ],[
                'muc_tieu'=>$mucTieu,
                'ket_qua'=>0,
                'id_nguoi_cap_nhat'=>auth()->user()->id
            ]);
            $chiTieuNam->save();
        }
        
    }
}