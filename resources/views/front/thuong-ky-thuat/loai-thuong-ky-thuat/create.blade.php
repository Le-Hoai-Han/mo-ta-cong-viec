<?php 
$current = "Thêm loại thưởng kỹ thuật";
$list = [    
    route('thuong-ky-thuat.loai-thuong-ky-thuat.index')=>'Danh mục loại thưởng kỹ thuật'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="col-12 col-md-6">
        <form name="frm_them_loai_thuong_ky_thuat" method="POST" action="{{route('thuong-ky-thuat.loai-thuong-ky-thuat.store')}}" id="frm_them_loai_thuong_ky_thuat" >
            @include('front.thuong-ky-thuat.loai-thuong-ky-thuat._form_loai_thuong_ky_thuat_no_button',[
                    'loaiThuongKyThuat'=>$loaiThuongKyThuat,
                    'buttonLabel'=>'Lưu'
                ])
        </form>
    </div>
</x-dashboard-layout>