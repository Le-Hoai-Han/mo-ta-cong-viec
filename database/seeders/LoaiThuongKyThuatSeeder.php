<?php

namespace Database\Seeders;

use App\Models\ThuongKyThuat\LoaiThuongKyThuat;
use Illuminate\Database\Seeder;

class LoaiThuongKyThuatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LoaiThuongKyThuat::create([
            'ma_loai' => 'MASTERCAM_LC',
            'ten_loai' => 'Cài đặt phần mềm Mastercam (LC)',
            'mo_ta' => 'Thưởng khi cài đặt phần mềm Mastercam (trường hợp LC)'
        ]);
        LoaiThuongKyThuat::create([
            'ma_loai' => 'MASTERCAM_DAO_TAO',
            'ten_loai' => 'Đào tạo phần mềm Mastercam ',
            'mo_ta' => 'Thưởng khi đào tạo phần mềm Mastercam'
        ]);
        LoaiThuongKyThuat::create([
            'ma_loai' => 'LAP_DAT_THIET_BI',
            'ten_loai' => 'Lắp đặt thiết bị',
            'mo_ta' => 'Thưởng kỹ thuật (AE) khi đào tạo và lắp đặt thiết bị'
        ]);

        
    }
}
