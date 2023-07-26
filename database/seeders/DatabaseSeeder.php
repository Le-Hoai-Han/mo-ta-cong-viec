<?php

namespace Database\Seeders;

use Database\Seeders\Thuong\ThuongKhoangThoiGianSeeder;
use Database\Seeders\Thuong\ThuongNhanVienSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ThuongNhanVienSeeder::class,
            ThuongKhoangThoiGianSeeder::class,
            
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
