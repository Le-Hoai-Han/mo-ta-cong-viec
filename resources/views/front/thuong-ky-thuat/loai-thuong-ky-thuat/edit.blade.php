<?php 
$current = "Cập nhật ".$loaiThuongKyThuat->ma_loai;
$list = [    
    route('thuong-ky-thuat.loai-thuong-ky-thuat.index')=>'Danh mục loại thưởng kỹ thuật'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="col-12 col-md-6">
        <form name="frm_them_loai_thuong_ky_thuat" method="POST" action="{{route('thuong-ky-thuat.loai-thuong-ky-thuat.update',$loaiThuongKyThuat)}}" id="frm_them_loai_thuong_ky_thuat" >
            @method('PUT')    
            @include('front.thuong-ky-thuat.loai-thuong-ky-thuat._form_loai_thuong_ky_thuat_no_button',[
                    'loaiThuongKyThuat'=>$loaiThuongKyThuat,
                    'buttonLabel'=>'Cập nhật'
                ])
        </form>
    </div>
</x-dashboard-layout>