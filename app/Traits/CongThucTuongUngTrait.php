<?php

namespace App\Traits;

trait CongThucTuongUngTrait
{ 
    /**
     * cong thuc tuong ung su dung chi tieu nay
     */
    public function getCongThucTuongUng() {
        return $this->chiTieu->congThucThuocNhomHienTai()->pluck('id')->first();
    }
}