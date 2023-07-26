<?php

namespace App\Traits;

use App\Models\NhanVien;
use App\Models\RequestStoring;
use Exception;
use Illuminate\Support\Facades\Http;

trait ParseDataKH
{
    private function parseDataKH($data)
    {
        $nhanViens = NhanVien::whereIn('getfly_id', array_column($data, 'id_nguoi_phu_trach'))->get(['getfly_id', 'ho_ten'])->keyBy('getfly_id');
    
        $khachHangs = collect($data)->mapWithKeys(function ($khachHang) use ($nhanViens) {
            $tenNguoiPhuTrach = $nhanViens->get($khachHang->id_nguoi_phu_trach)->ho_ten ?? '';
            
            return [$khachHang->id => [
                'id' => $khachHang->id,
                'ma_khach_hang' => $khachHang->ma_khach_hang,
                'ten_khach_hang' => $khachHang->ten_khach_hang,
                'dien_thoai' => $khachHang->dien_thoai,
                'email' => $khachHang->email,
                'nguoi_phu_trach' => $tenNguoiPhuTrach,
            ]];
        })->toArray();
    
        return [
            'khachHang' => $khachHangs,
        ];
    }

    private function parseDataShow($data)
    {
        if (empty($data)) {
            throw new Exception('Data is empty');
        }
    
        $nguoiPhuTrach = NhanVien::where('getfly_id', $data[0]->id_nguoi_phu_trach)->first();
        if ($nguoiPhuTrach == null) {
            throw new Exception('Nguoi phu trach is null');
        }
    
        $nhomList = array_map(function ($nhom) {
            return $nhom->ten_loai;
        }, $data[0]->nhom_khach_hang);
    
        $nguonList = array_map(function ($nguon) {
            return $nguon->ten_loai;
        }, $data[0]->nguon_khach_hang);
    
        $arrKH = [
            'id' => $data[0]->id,
            'ma_khach_hang' => $data[0]->ma_khach_hang,
            'ten_khach_hang' => $data[0]->ten_khach_hang,
            'dien_thoai' => $data[0]->dien_thoai,
            'dia_chi' => $data[0]->dia_chi,
            'email' => $data[0]->email,
            'nguoi_phu_trach' => $nguoiPhuTrach->ho_ten,
            'moi_quan_he' => $data[0]->moi_quan_he,
            'nguoi_lien_he' => $data[0]->lien_he,
            'nhom_khach_hang' => implode('|', $nhomList),
            'nguon_khach_hang' => implode('|', $nguonList)
        ];
    
        return [
            'khachHang' => $arrKH
        ];
    }

    public function getDataShowKH($account_id)
    {
        $tokenKeyKH = config('services.khach-hang.key');
        $url = config('services.khach-hang.url-show');
        try{
            $response = Http::withHeaders([
                'accept'=>'application/json',
                'Authorization' => $tokenKeyKH
            ])->get($url.$account_id);
            $dataKhachHang = $this->parseDataShow(json_decode($response->body()));
            return $dataKhachHang;
        }catch(Exception $e){
            return null;
        }
       
    }

    /**
     * lay danh sach nguoi lien he tu id khach hang
     */
    public function layDanhSachNguoiLienHe($dataKhachHang) : array
    {
        return $dataKhachHang['khachHang']['nguoi_lien_he'];
    }

   
}
