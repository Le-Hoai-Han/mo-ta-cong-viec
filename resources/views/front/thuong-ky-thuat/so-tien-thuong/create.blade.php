<?php 
$current = "Thêm thông tin";
$list = [    
    route('thuong-ky-thuat.so-tien-thuong.index')=>'Danh mục số tiền thưởng quy ước'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="col-12 col-md-6">
        <form name="frm_them_so_tien_thuong" method="POST" action="{{route('thuong-ky-thuat.so-tien-thuong.store')}}" id="frm_them_so_tien_thuong" >
            @include('front.thuong-ky-thuat.so-tien-thuong._form_no_button',[
                    'soTienThuongKyThuat'=>$soTienThuongKyThuat,
                    'buttonLabel'=>'Lưu',
                ])
        </form>
    </div>
</x-dashboard-layout>