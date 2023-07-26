<?php 

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use App\Jobs\GuiMailChoAdmin;

trait DriveApi
{
    public function urlDrive()
    {
        return config('services.drive.url');
    }

    public function keyDrive()
    {
        return config('services.drive.key');
    }

    public function postToDrive($url,$data)
    {
        $reg = '/_+/';
        $tenNguoiLienHe = preg_replace($reg, ' ', $data->ten_nguoi_lien_he);


        // dd($hoTen);
        if($data->khachHang)
        $nguoiLienHe= $data->khachHang->lienHeKhachHang->where('ho_va_ten',$tenNguoiLienHe)->first();
        if($nguoiLienHe == null){
            GuiMailChoAdmin::dispatch($data)->delay(now()->addSecond(2));
        }

        $order=[
            'ma_don_hang' => $data->ma_don_hang,
            'nguoi_tao_don' => $data->ten_nguoi_tao,
            'ten_nguoi_lien_he' => $tenNguoiLienHe,
            'email_nguoi_lien_he' =>$nguoiLienHe->email,
        ];
         
        $reponse = Http::withHeaders([
                'Accept'=>'application/json',
                'Authorization' => $this->keyDrive(),
                'Custom-Header' => 'Custom Value',
            ])->post($this->urlDrive() . $url,$order);
            
            return $reponse;

    }




}

?>