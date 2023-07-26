<?php 
namespace App\Traits;

trait XoaGachChanTen  
{
    /**
     * bỏ khoảng trắng trong tên người
     */
    public function xoaGachChanTen($tenNguoi) : string 
    {
        $reg = '/_+/'; 
        return trim(preg_replace($reg, ' ', $tenNguoi));
    }

}