<?php

namespace Database\Seeders\Thuong;

use App\Models\CongThuc\ChiTieuCaNhanThoiGian;
use App\Models\CongThuc\DanhSachChiTieu;
use App\Models\Thuong\ThuongKhoangThoiGian;
use Illuminate\Database\Seeder;

class ThuongKhoangThoiGianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thuong = ThuongKhoangThoiGian::updateOrcreate([
            'id_nhan_vien'=>1,
            'nam'=>date('Y'),
            'thang_bat_dau'=>1,
            'thang_ket_thuc'=>3
        ]);

        $idChiTieu = DanhSachChiTieu::getIdChiTieuDoanhSoTheoNhom(1);
        ChiTieuCaNhanThoiGian::updateOrCreate([
            'id_chi_tieu'=>$idChiTieu,
            'id_thuong_thoi_gian'=>$thuong->id
        ],[
            'muc_tieu'=>5000000,
            'ket_qua'=>1,
            'id_nguoi_cap_nhat'=>1
        ]);

    }
}
