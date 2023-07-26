<?php

namespace Database\Factories\DonHang;

use Illuminate\Database\Eloquent\Factories\Factory;

class DonHangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ma_don_hang'=>$this->faker->name(),
            'ten_nguoi_tao'=>$this->faker->name(),
            'id_nhan_vien'=>1,
            'doanh_so'=>$this->faker->numberBetween(50000,1000000),
            'doanh_thu'=>$this->faker->numberBetween(50000,1000000),
            'da_thanh_toan'=>0,
            'ngay_tao_don'=>$this->faker->date(),           
            'duoc_tinh_thuong'=>0,
            'da_cap_nhat'=>0,
            'trang_thai'=>0,
            'tien_thuong_don_hang'=>0,
            'la_nguon_marketing'=>0,
            'la_don_hang_thanh_ly'=>0,
            'chi_phi_phat_sinh'=>0
        ];
    }
}
