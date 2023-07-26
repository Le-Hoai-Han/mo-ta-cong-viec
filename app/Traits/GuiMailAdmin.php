<?php

namespace App\Traits;

use App\Mail\GuiMailVeAdmin;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

trait GuiMailAdmin
{
    // Gửi mail về cho admin 
    public function guiMailAdmin($donHang){
        Mail::to('khanh.tran@3ds.vn')
                ->cc(['han.le@3ds.vn'])
                ->send(new GuiMailVeAdmin($donHang));
    }
}
