<?php 

namespace App\Services\CongThuc;

use App\Models\CongThuc\CongThucTinh;
use App\Models\CongThuc\DanhSachChiTieu;

class CongThucService {
    /**
     * tra ve cong thuc moi
     */
    public function saoChepCongThuc(DanhSachChiTieu $chiTieuCu,DanhSachChiTieu $chiTieuMoi) : void
    {
        //sao chep cong thuc cha de lay id cong thuc cha
        //tam thoi bo qua do phuc tap
        //sao chep noi dung cong thuc
        //gan lien ket cho cong thuc chi tieu
        // return $congThucMoi;
        $congThucGoc = $chiTieuCu->danhSachCongThuc()->first();
        $this->_saoChepNoiDungCongThuc($congThucGoc,$chiTieuCu->id,$chiTieuMoi->id,$chiTieuMoi->id_nhom_nhan_vien);
    }

    /**
     * return id cong thuc cha moi
     * hoac null cho khong co cong thuc cha
     */
    /*
    private function _saoChepCongThucCha(CongThucTinh $congThucGoc, int $idChiTieuCu, int $idChiTieuMoi, int $idNhomNhanVien): ? CongThucTinh
    {
        if($congThucGoc->congThucCha != null) {
            $congThucChaMoi = $this->_saoChepNoiDungCongThuc()
            return $congThucGoc->congThucChaMoi;
        }
        return null;
    }*/

    private function _saoChepNoiDungCongThuc(CongThucTinh $congThucGoc,int $idChiTieuCu, int $idChiTieuMoi, int $idNhomNhanVien) : CongThucTinh
    {
        $congThucMoi = CongThucTinh::firstOrNew([
            'ten_cong_thuc'=>$congThucGoc->ten_cong_thuc,
            'id_nhom_nhan_vien'=>$idNhomNhanVien
        ],[
            'mo_ta'=>$congThucGoc->mo_ta,
            'noi_dung'=> str_replace($idChiTieuCu,$idChiTieuMoi,$congThucGoc->noi_dung),
            'dang_su_dung'=>$congThucGoc->dang_su_dung,
            'id_nguoi_tao'=> $congThucGoc->id_nguoi_tao,
            'id_cong_thuc_cha'=>NULL
            
        ]);

        $congThucMoi->save();
        return $congThucMoi;
    }

    // private function _saoChepCongThucK2()
    // {

    // }
}