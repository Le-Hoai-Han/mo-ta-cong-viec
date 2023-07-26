<?php

namespace App\Traits\DonHang;

use App\Traits\GetflyApi;

trait GetDataDHGetfly
{
    use GetflyApi;

    /**
     * lay thong tin don hang tu getfly
     */
    public function getDonHangTuGetFly($maDonHang)
    {
        $url = "/orders/". $maDonHang;
        $jsonData = json_decode($this->getToGetFly($maDonHang,$url));
              
        return $jsonData;
    }

    /**
     * lay thong tin don hang tu getfly
     */
    public function getDonHangTuGetFlyDecode($maDonHang) : array
    {
        
        $jsonData = $this->getDonHangTuGetFly($maDonHang);
        $dataGetFly = json_decode(json_encode($jsonData),true);       
        return $dataGetFly;
    }

    /**
     * lay order info tu request getfly
     */
    public function getOrderInfo($dataGetFly) : array
    {
        return $dataGetFly['order_info'];

    }

}