<?php

namespace App\Traits;

use App\Models\CongThuc\ChiTieuCaNhan;
use App\Models\CongThuc\ChiTieuCaNhanThoiGian;
use App\Models\CongThuc\CongThucTinh;
use App\Models\DanhMucThangNam;
use App\Models\RequestStoring;
use App\Models\Thuong\ThuongKhoangThoiGian;
use Exception;

trait SuDungCongThucThoiGianTrait
{ 
    use CongThucThuongThoiGianTrait;
    use ThuongMoMoiTrait;
    /**
     * tach phan thay cong thuc cong don quy ra rieng
     */
    // static public function thayCongThucTinhDoanhSoCongDonTheoQuy(string $noiDungCongThuc,int $idNhanVien,int $idNhomNhanVien,DanhMucThangNam $thangNam) : string
    // {
    //     if(preg_match(CongThucTinh::MUC_TIEU_DOANH_SO_QUY_REG,$noiDungCongThuc)) {
    //         // can edit cho này
    //         $mucTieuNam = ThuongKhoangThoiGian::getMucTieuDoanhSoQuy($idNhanVien,$thangNam->thang, $thangNam->nam,$idNhomNhanVien);
    //         $doanhSoCongDon = ChiTieuCaNhan::getDoanhSoCongDonTheoThang($thangNam->id,$idNhanVien,$idNhomNhanVien);            
    //         $noiDungCongThuc = str_replace('{MUC_TIEU_DOANH_SO_QUY}',$mucTieuNam,$noiDungCongThuc);
    //         $noiDungCongThuc = str_replace('{DOANH_SO_CONG_DON}',$doanhSoCongDon,$noiDungCongThuc);         
    //     }
        
    //     return $noiDungCongThuc;

    // }

    /**
     * luu them cot noi dung tinh
     */
    protected function _luuNoiDungTinh($noiDungCongThuc) : void
    {
        $this->noi_dung_tinh = $noiDungCongThuc;
        $this->saveQuietly();
    }

    /**
     * thay the noi dung cong thuc
     */
    protected function _thayTheBienSoCongThuc($noiDungCongThuc,CongThucTinh $congThucTinh) : string 
    {
        if ($congThucTinh->danhSachBienSo->isNotEmpty()) {
            foreach ($congThucTinh->danhSachBienSo as $bienSo) {
                $noiDungCongThuc = str_replace("{bien:" . $bienSo->id . "}", $bienSo->gia_tri, $noiDungCongThuc);
                // $dsBienSo[$bienSo->id] = "bien:".$bienSo->id;
            }
        }
        return $noiDungCongThuc;
    }
    

    /**
     * thay the cong thuc con trong cong thuc {congthuc:x} + {congthuc:y}
     */
    protected function _thayTheCongThucCon($noiDungCongThuc,$idThuongThoiGian) : string
    {
        if (preg_match_all('/congthuc:\d+/', $noiDungCongThuc, $congThucCon)) {
            $congThucConID = str_replace('congthuc:', '', $congThucCon[0]);
            $congThucCon = CongThucTinh::whereIn('id', $congThucConID)->get();

            if ($congThucCon !== null) {
                foreach ($congThucCon as $congThuc) {
                    $idCongThuc = $congThuc->id;
                    // $giaTriCongThuc = $congThuc->suDungCongThuc();
                    $congThucThuongThoiGian = $this->_loadCongThucThoiGian($idCongThuc,$idThuongThoiGian);
                    try{
                        if ($congThucThuongThoiGian !== null) {
                            $congThucDaTinh = $congThucThuongThoiGian->tinhKetQua();

                            $giaTriCongThuc = $congThucDaTinh->ket_qua_tinh;

                        } else {
                            $giaTriCongThuc = 0;
                        }
                    }catch(Exception $e) {
                        echo "error: ".$e->getMessage();
                        
                        dd($congThucDaTinh);
                    }


                    $noiDungCongThuc = str_replace('{congthuc:' . $idCongThuc . '}', $giaTriCongThuc, $noiDungCongThuc);
                    
                    // echo $idCongThuc . " - " . $congThuc->noi_dung . " - " . $giaTriCongThuc . ";";
                }
            }
        }
        return $noiDungCongThuc;
    }

    /**
     * thay the chi tieu trong cong thuc
     */
    protected function _thaytheChiTieuCongThuc($noiDungCongThuc,CongThucTinh $congThucTinh,$idThuongThoiGian) : string
    {
        if ($congThucTinh->danhSachChiTieu->isNotEmpty()) {
            foreach ($congThucTinh->danhSachChiTieu as $chiTieu) {
                $chiTieuCaNhan = ChiTieuCaNhanThoiGian::where([
                    'id_chi_tieu'=>$chiTieu->id,
                    'id_thuong_thoi_gian'=>$idThuongThoiGian
                ])->first();
                // $dsChiTieu[$chiTieu->id] = "chitieu:".$chiTieu->id.".";
                $noiDungCongThuc = str_replace("{chitieu:" . $chiTieu->id . "}", $chiTieuCaNhan->ti_le_dat_duoc, $noiDungCongThuc);
            }
        }
        return $noiDungCongThuc;
    }

    /**
     * thay the cong thuc case thanh gia tri
     */
    protected function _thayTheCongThucDieuKien($noiDungCongThuc,int $idThuongThoiGian) : string 
    {
        if (preg_match(CongThucTinh::CASE_REG, $noiDungCongThuc, $mangDieuKien)) {
            $chuoiDieuKien = $mangDieuKien[0];
            $giaTriDieuKien = $this->_tinhDieuKien($chuoiDieuKien, $idThuongThoiGian);
            $noiDungCongThuc = str_replace("{" . $chuoiDieuKien . "}", $giaTriDieuKien, $noiDungCongThuc);
        }
        return $noiDungCongThuc;
    }

    

    /**
     * tinh ham case trong cong thuc K2
     */
    public function _tinhDieuKien($chuoiDieuKien, $idThuongThoiGian)
    {
 
        $giaTriCongThuc = 0;
        $giaTriDieuKien = 0;

        if (preg_match("/case:\d+/", $chuoiDieuKien, $idDieuKien)) {
            $idCongThuc = str_replace("case:", "", $idDieuKien[0]);


            $congThucThoiGian = $this->_loadCongThucThoiGian($idCongThuc,$idThuongThoiGian);
            if ($congThucThoiGian !== null) {
                $congThucDaTinh = $congThucThoiGian->tinhKetQua();
                $giaTriCongThuc = $congThucDaTinh->ket_qua_tinh;
            } else {
                $giaTriCongThuc = 0;
            }
        }
        
        if (preg_match_all("/(\d+):(\d+)/", $chuoiDieuKien, $mangDieuKienGoc)) {
            $mangDieuKien = array_combine($mangDieuKienGoc[1], $mangDieuKienGoc[2]);
            foreach ($mangDieuKien as $ketQua => $dieuKien) {
                if (($giaTriCongThuc) >= $dieuKien) {
                    $giaTriDieuKien = $ketQua ;
                    break;
                }
            }
        }

        return $giaTriDieuKien;
       

    }

    /**
     * tach phan thay cong thuc cong don quy ra rieng
     */
    protected function _thayTheCongThucCongDon(string $noiDungCongThuc,ThuongKhoangThoiGian $thuongKhoangThoiGian) : string
    {
        if(preg_match(CongThucTinh::MUC_TIEU_DOANH_SO_QUY_REG,$noiDungCongThuc)) {
            $chiTieuDoanhSoThoiGian = $thuongKhoangThoiGian->chiTieuDoanhSo();
            if($chiTieuDoanhSoThoiGian==null) {
                $mucTieu = 0;
                $ketQua = 0;
            } else {
                $mucTieu = $chiTieuDoanhSoThoiGian->muc_tieu;
                $ketQua = $chiTieuDoanhSoThoiGian->ket_qua;
            }               

            $noiDungCongThuc = str_replace('{MUC_TIEU_DOANH_SO_QUY}',$mucTieu,$noiDungCongThuc);
            $noiDungCongThuc = str_replace('{DOANH_SO_CONG_DON}',$ketQua,$noiDungCongThuc);         
        }
        
        return $noiDungCongThuc;

    }

    /**
     * thay cong thuc chinh
     */
    protected function _thayTheCongThucChinh($noiDungCongThuc,CongThucTinh $congThucTinh,ThuongKhoangThoiGian $thuongKhoangThoiGian) : string 
    {
        if ($congThucTinh->la_cong_thuc_chinh) {
                
            if($thuongKhoangThoiGian->loai == ThuongKhoangThoiGian::LOAI_THUONG_NAM && $thuongKhoangThoiGian->nhanVien->laQuanLy()){
                $tongTienNoXauCuaTeam = $thuongKhoangThoiGian->nhanVien->getTongNoXauCuaTeam();
                $tongTienThuongMoMoiCuaCaTeam = $this-> __tienThuongMoMoiCuaCaTeam( $thuongKhoangThoiGian,$thuongKhoangThoiGian->nhanVien,'nam');

                if (preg_match('/ngansachthuong/', $noiDungCongThuc)) {
                    $noiDungCongThuc = str_replace('{ngansachthuong}', $thuongKhoangThoiGian->tong_ngan_sach_thuong - $tongTienNoXauCuaTeam *0.05 , $noiDungCongThuc);
                }
                
                if (preg_match('/thuongmomoi/', $noiDungCongThuc)) {
                    $noiDungCongThuc = str_replace('{thuongmomoi}', $this-> __tienThuongMoMoiCaNhan( $thuongKhoangThoiGian,$thuongKhoangThoiGian->nhanVien,'nam') +  $tongTienThuongMoMoiCuaCaTeam*0.3, $noiDungCongThuc);
                    return $noiDungCongThuc;
                }
            }


            if (preg_match('/ngansachthuong/', $noiDungCongThuc)) {
                $noiDungCongThuc = str_replace('{ngansachthuong}', $thuongKhoangThoiGian->tong_ngan_sach_thuong, $noiDungCongThuc);
            }

            if (preg_match('/thuongmomoi/', $noiDungCongThuc)) {
                $noiDungCongThuc = str_replace('{thuongmomoi}', $this-> __tienThuongMoMoiCaNhan( $thuongKhoangThoiGian,$thuongKhoangThoiGian->nhanVien,'nam'), $noiDungCongThuc);
            }
        }
        // dd($noiDungCongThuc);
        return $noiDungCongThuc;
    } 

    
}