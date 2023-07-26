<?php 
$current = $noXau->donHang->ma_don_hang." - ".$nhanVien->ho_ten;
$list = [    
    url('/no-xau')=>'Danh sách nợ xấu'    
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row mt-4" >           
            @include('front.thuong.noxau.show._thong_tin_don_hang',[
                'noXau'=>$noXau,
                'donHang'=>$donHang
                ])
        </div>
    </div>

    <div class="sub-div">
        <div class="row mt-4" >       
            <div class="col-xs-12 col-md-6 col-xl-4">
    
            @include('front.thuong.noxau.show._thong_tin_no',[
                'noXau'=>$noXau,
                ])
            </div>
            <div class="col-xs-12 col-md-6 col-xl-8">

            @include('front.thuong.noxau.show._thong_tin_no_da_tru',[
                'noXau'=>$noXau,
                ])
            </div>
        </div>
    </div>
    
</x-dashboard-layout>