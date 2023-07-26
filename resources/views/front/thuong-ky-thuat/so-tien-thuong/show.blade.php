<?php 
$current = "Xem tiền thưởng cho kỹ thuật loại ".$soTienThuongKyThuat->mo_ta." - ".$soTienThuongKyThuat->phien_ban;
$list = [    
    route('thuong-ky-thuat.so-tien-thuong.index')=>'Danh mục số tiền thưởng quy ước'
]
?>

<x-dashboard-layout :current="$current" :list="$list">
    <div class="row">
        <div class="col-12 col-md-6">
            @include('front.thuong-ky-thuat.so-tien-thuong._thong_tin_chung',[
                'soTienThuongKyThuat'=>$soTienThuongKyThuat,
            ])
        </div>
        <div class="col-12 col-md-6">
            @include('front.thuong-ky-thuat.so-tien-thuong._thong_tin_phien_ban',[
                'soTienThuongKyThuat'=>$soTienThuongKyThuat,
            ])
        </div>
    
        <div class="col-12">
            @include('front.thuong-ky-thuat.so-tien-thuong._danh_sach_san_pham',[
                    'soTienThuongKyThuat'=>$soTienThuongKyThuat,
                    'dsSanPham'=>$dsSanPham
                ])
        </div>
    </div>
@push('styles')
<style>
.table.table-borderless tr:last-child th,
.table.table-borderless tr:last-child td{
    border:none !important;
}

.table.table-detail th{
    /* text-align: right; */
    width:40%;
}
</style>
@endpush
</x-dashboard-layout>