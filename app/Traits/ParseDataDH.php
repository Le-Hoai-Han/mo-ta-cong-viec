<?php

namespace App\Traits;

use App\Models\RequestStoring;
use Exception;

trait ParseDataDH
{
    public function checkDH3DM($maDH){
        $reg="/".config('services.3dm.ma_don_hang')."/i";
        return preg_match($reg,$maDH);
    }
    private function parseData($data)
    {
        foreach ($data as $order => $productList) {

            // $str = str_replace('{"id_don_hang','"id_don_hang',$key);
            $str = str_replace(',"danh_sach_san_pham_theo_json":', '}', $order);
            $orderDetail = json_decode($str, true);
            if (isset($orderDetail['doanh_so'])) {
                $orderDetail['doanh_so'] = (float)str_replace(",", "", $orderDetail['doanh_so']);
            } else {
                $orderDetail['doanh_so'] = 0;
            }

            if (isset($orderDetail['doanh_thu'])) {
                $orderDetail['doanh_thu'] = (float)str_replace(",", "", $orderDetail['doanh_thu']);
            } else {
                $orderDetail['doanh_thu'] = 0;
            }

            if (isset($orderDetail['chi_phi_phat_sinh'])) {
                $orderDetail['chi_phi_phat_sinh'] = (float)str_replace(",", "", $orderDetail['chi_phi_phat_sinh']);
            } else {
                $orderDetail['chi_phi_phat_sinh'] = 0;
            }

            if (isset($orderDetail['chi_phi_khac'])) {
                $orderDetail['chi_phi_khac'] = (float)str_replace(",", "", $orderDetail['chi_phi_khac']);
            } else {
                $orderDetail['chi_phi_khac'] = 0;
            }

            if ($productList !== null) {
                foreach ($productList as $key => $value) {
                    $productStr = "[" . $key . "]";
                    $productList = json_decode($productStr, true);
                }
            }
        }

        return [
            'orderDetail' => $orderDetail,
            'productList' => $productList
        ];
    }

    /**
     * lay ma don hang va ngay cap nhat
     */
    private function parseDataShort($data)
    {

        foreach ($data as $order => $productList) {
            $order = str_replace(',"danh_sach_san_pham_theo_json":', '}', $order);
            $orderDetail = json_decode($order, true);
            break;
        }

        return $orderDetail;
    }
}
