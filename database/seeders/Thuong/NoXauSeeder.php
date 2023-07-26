<?php

namespace Database\Seeders\Thuong;

use App\Models\DonHang\DonHang;
use App\Models\NhanVien;
use App\Models\Thuong\ChiTietNoXauDaTru;
use App\Models\Thuong\NoXauThuocNhanVien;
use Illuminate\Database\Seeder;

class NoXauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dsDonHang = DonHang::limit(3)->get();
        


        for($i=0;$i<=5;$i++) {
            $year = date('Y');
            $randomTimestamp = mt_rand(strtotime("{$year}-01-01"), strtotime("{$year}-12-31"));
            $randomDate = date('Y-m-d', $randomTimestamp);

            $min = 5000000;
            $max = rand($min,$min*5);
            $tongSoTien = mt_rand() / mt_getrandmax() * ($max - $min) + $min;
            $tienDaTru = mt_rand() / mt_getrandmax() * ($tongSoTien - $min) + $min;
            $noXau = NoXauThuocNhanVien::firstOrCreate([
                'id_don_hang'=>$dsDonHang->random()->id,
                'id_nhan_vien'=>$dsDonHang->random()->nhanVien->id
            ],[
                'tong_so_tien'=>$tongSoTien,
                'tien_da_tru'=>$tienDaTru,
                'tien_con_lai'=>$tongSoTien - $tienDaTru,
                'ngay_bat_dau'=>$randomDate,
                'ngay_ket_thuc'=>null
            ]);

            $chiTietTienDaTru = ChiTietNoXauDaTru::firstOrCreate([
                'id_no_xau'=>$noXau->id,
                'ngay_tru_no'=>$randomDate
            ],[
                'so_tien'=>$tienDaTru
            ]);
        }
    }
}
