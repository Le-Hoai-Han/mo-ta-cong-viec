<?php
namespace App\Traits\ThuongKyThuat;

use App\Models\DonHang\DonHang;
use App\Models\ThuongKyThuat\LoaiThuongKyThuat;
use App\Models\ThuongKyThuat\SoTienThuongKyThuat;
use App\Models\ThuongKyThuat\SoTienThuongKyThuatTheoSanPham;
use App\Models\ThuongKyThuat\ThuongKyThuatDonHang;

trait ThuongLapDatTrait
{
    public function tinhThuongLapDat(DonHang $donHang) : void 
    {   
        $loai = LoaiThuongKyThuat::where('ma_loai',ThuongKyThuatDonHang::LOAI_LAP_DAT)->first();
        $tienThuongLapDatDonHang = ThuongKyThuatDonHang::firstOrNew([
            'id_don_hang'=>$donHang->id,
            'id_loai' => $loai->id
        ]);
        $soTienThuong = 0;
        $moTa = '';
        foreach($donHang->sanPhams as $sanPham) {
            $danhMuc = $sanPham->danhMucSanPham;
            // dd($sanPham->danhMucSanPham);
            if(($sanPham->danhMucSanPham->dong_san_pham != "") && !$sanPham->danhMucSanPham->checkThuongGeomagic()) {
                $soTienThuongLapDat = SoTienThuongKyThuatTheoSanPham::where([
                    ['id_san_pham','=',$sanPham->id_san_pham]                    
                ])
                ->whereRelation('soTienThuong','dang_su_dung',SoTienThuongKyThuat::TT_DANG_SU_DUNG)->first()->soTienThuong;
                if($sanPham->so_luong < $soTienThuongLapDat->so_luong_gioi_han) {
                    $thuongLapDat = $soTienThuongLapDat->tien_thuong_co_ban;
                } else {
                    $thuongLapDat = $soTienThuongLapDat->tien_thuong_vuot_muc;
                }
                $soTienThuong += $thuongLapDat;
                $moTa .= "Thưởng lắp đặt: ".$danhMuc->ten_san_pham." x".$sanPham->so_luong." là ".thuGonSoLe($thuongLapDat)."đ<br>";
                // dd($moTa);
            }
        }

        /**
         * so tien thuong >0 mới lưu
         */
        if($soTienThuong>0) {
            $tienThuongLapDatDonHang->so_tien_thuong = $soTienThuong;
            $tienThuongLapDatDonHang->mo_ta = $moTa;
            $tienThuongLapDatDonHang->ngay_cap_nhat = date('Y-m-d H:i:s');
            $tienThuongLapDatDonHang->save();
        }
        
        
    }
}