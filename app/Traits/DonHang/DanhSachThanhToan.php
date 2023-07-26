<?php

namespace App\Traits\DonHang;

use App\Models\DonHang\DonHang;
use App\Models\DonHang\ThanhToanThuocDonHang;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

trait DanhSachThanhToan
{
    /**
     * don hang thanh toan trong thang
     */
    public function getDsThanhToanTheoThangNam($thang,$nam,$dsThanhToanMax) : ?Collection
    {
        
        $dsThanhToan = ThanhToanThuocDonHang::whereYear('ngay_thanh_toan',$nam)
            ->whereMonth('ngay_thanh_toan',$thang)                     
            ->whereIn('id',$dsThanhToanMax)
            ->orderBy('ngay_thanh_toan','desc')   
            ->get();
            
        return $dsThanhToan;
    }

    /**
     * lay ds max ngay thanh toan
     */
    public function getDsMaxNgayThanhToan($dsDonHang) : Collection
    {
        $subMaxThanhToan = ThanhToanThuocDonHang::select(DB::raw('id_don_hang, MAX(ngay_thanh_toan) as max_ngay_thanh_toan'))
        ->whereIn('id_don_hang',$dsDonHang)
            // ->whereIn('id_don_hang',[21566])
            ->groupBy('id_don_hang');
            // ->having('ngay_thanh_toan')
            
        $dsThanhToanMax = ThanhToanThuocDonHang::select('*')
                            ->joinSub($subMaxThanhToan,'max_thanh_toan',function($join){
                                $join->on('cms___thanh_toan_thuoc_don_hang.id_don_hang','=','max_thanh_toan.id_don_hang');
                                $join->on('cms___thanh_toan_thuoc_don_hang.ngay_thanh_toan','=','max_thanh_toan.max_ngay_thanh_toan');
                            })
                            ->get();
        return $dsThanhToanMax;   
    }

    /**
     * don hang thanh toan trong nam
     */
    public function getDsThanhToanTheoNam($nam,$dsThanhToanMax) : ?Collection
    {
        
        $dsThanhToan = ThanhToanThuocDonHang::whereYear('ngay_thanh_toan',$nam)
            ->whereIn('id',$dsThanhToanMax)
            ->orderBy('ngay_thanh_toan','desc')   
            ->get();
            
        return $dsThanhToan;
    }

}