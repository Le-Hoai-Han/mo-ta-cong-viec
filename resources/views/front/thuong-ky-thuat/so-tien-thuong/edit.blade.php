<?php 
$current = "Cập nhật ".$soTienThuongKyThuat->mo_ta." - ".$soTienThuongKyThuat->phien_ban;
$list = [    
    route('thuong-ky-thuat.so-tien-thuong.index')=>'Danh mục số tiền thưởng quy ước'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="col-12 col-md-6">
        <form name="frm_cap_nhat_so_tien_thuong" method="POST" action="{{route('thuong-ky-thuat.so-tien-thuong.update',$soTienThuongKyThuat)}}" id="frm_them_so_tien_thuong" >
            @method('PUT')
            @include('front.thuong-ky-thuat.so-tien-thuong._form_no_button',[
                    'soTienThuongKyThuat'=>$soTienThuongKyThuat,
                    'buttonLabel'=>'Cập nhật',
                ])
        </form>
    </div>
</x-dashboard-layout>