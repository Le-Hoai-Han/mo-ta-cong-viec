<?php

namespace Database\Seeders\Thuong;

use App\Models\CongThuc\ChiTieuCaNhan;
use App\Models\CongThuc\DanhSachChiTieu;
use App\Models\DanhMucThangNam;
use App\Models\Thuong\ThuongNhanVien;
use App\Services\Thuong\ThuongNhanVienService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class ThuongNhanVienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Auth::loginUsingId(1);
        $service = new ThuongNhanVienService();
        $dsThangID = DanhMucThangNam::where([
            ['thang','<',3],
            ['nam','=',date('Y')]
        ])->get()->pluck('id')->toArray();
        $dsChiTieuNhom = DanhSachChiTieu::where([
            'id_nhom_nhan_vien'=>1
        ])->get();

        $dsChiTieu = [];
        foreach($dsChiTieuNhom as $chiTieu) {
            $dsChiTieu[$chiTieu->id] = $chiTieu->muc_tieu_mac_dinh;
        }
        // dd($dsChiTieuNhom);
        $service->themThuongNhanVien([1],$dsThangID,$dsChiTieu,1); 
        //cho full ket qua thang dau tien de test
        $dsChiTieuCaNhan = ChiTieuCaNhan::where([
            'id_thang_nam'=>$dsThangID[0],
            'id_nhan_vien'=>1
        ])->whereIn('id_chi_tieu',array_keys($dsChiTieu))->get();
        foreach($dsChiTieuCaNhan as $chiTieuCaNhan) {
            $chiTieuCaNhan->ket_qua_dat_duoc = $chiTieuCaNhan->muc_tieu;
            $chiTieuCaNhan->save();
        }
    
    }
}
