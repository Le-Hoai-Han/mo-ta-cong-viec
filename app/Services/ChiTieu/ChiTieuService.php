<?php 

namespace App\Services\ChiTieu;

use App\Models\CongThuc\DanhSachChiTieu;

class ChiTieuService {
    public function themMoiChiTieu($tenChiTieu, $loaiChiTieu, $mucTieuMacDinh, $chieuHuongTot, $moTa, $idNhomNhanVien, $thuTuSapXep = 99) : DanhSachChiTieu
    {
        $chiTieu = DanhSachChiTieu::create([
            'ten_chi_tieu'=>$tenChiTieu,
            'loai_chi_tieu'=>$loaiChiTieu,
            'muc_tieu_mac_dinh'=>formatGiaTriDeLuu($mucTieuMacDinh),
            'chieu_huong_tot'=>$chieuHuongTot,
            'mo_ta'=>$moTa,
            'id_nhom_nhan_vien'=>$idNhomNhanVien,
            'thu_tu_sap_xep'=>$thuTuSapXep
        ]);
        return $chiTieu;
    }

    public function capNhatChiTieu(DanhSachChiTieu $chiTieu,$tenChiTieu,$loaiChiTieu,$mucTieuMacDinh,$chieuHuongTot,$moTa, $idNhomNhanVien,$thuTuSapXep) : DanhSachChiTieu 
    {
        $chiTieu->update([
            'ten_chi_tieu'=>$tenChiTieu,
            'loai_chi_tieu'=>$loaiChiTieu,
            'muc_tieu_mac_dinh'=>formatGiaTriDeLuu($mucTieuMacDinh),
            'chieu_huong_tot'=>$chieuHuongTot,
            'mo_ta'=>$moTa,
            'thu_tu-sap_xep'=>$thuTuSapXep,
            'id_nhom_nhan_vien'=>$idNhomNhanVien
        ]);
        return $chiTieu;
    }
}