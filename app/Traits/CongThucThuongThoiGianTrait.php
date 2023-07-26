<?php

namespace App\Traits;

use App\Models\CongThuc\CongThucThuongThoiGian;
use App\Models\CongThuc\CongThucTinh;
use App\Models\Thuong\ThuongKhoangThoiGian;

trait CongThucThuongThoiGianTrait
{ 
    /**
     * load model
     */
    protected function _loadCongThucThoiGian($idCongThuc,$idThuongThoiGian) : CongThucThuongThoiGian
    {
        return CongThucThuongThoiGian::where([
            'id_cong_thuc_tinh' => $idCongThuc,
            'id_thuong_thoi_gian'=>$idThuongThoiGian
        ])->first();
    }

    /**
     * luu cong thuc thuong theo thoi gian
     * tuong tu ket qua tinh thuong
     */
    public function luuCongThucThuongThoiGian(ThuongKhoangThoiGian $thuongKhoangThoiGian) : void 
    {
        $congThucThuongNhom = CongThucTinh::where([
            'loai'=>CongThucTinh::LOAICT_CHINH,
            'id_nhom_nhan_vien'=>$thuongKhoangThoiGian->nhanVien->id_nhom_nhan_vien
        ])->first();
        
        CongThucThuongThoiGian::createCongThucThoiGian($congThucThuongNhom,$thuongKhoangThoiGian->id);
    }
}