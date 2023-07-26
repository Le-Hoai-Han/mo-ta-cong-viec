<?php 
$current = "Thông tin thưởng: $nhanVien->ho_ten tháng $thuongSanPhamQuanLy->thang năm $thuongSanPhamQuanLy->nam";
$list = [
    route('thuong-quan-ly.san-pham.index') => 'Danh sách thông tin thưởng quản lý sản phẩm'
];
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
            <div class="col-6">
                @include('front.thuong-quan-ly.san-pham.show._thong_tin_chung',[
                    'thuongSanPhamQuanLy'=>$thuongSanPhamQuanLy,
                    'dsThuong' => $dsThuong
                    ])
            </div>
            <div class="col-6">
                @include('front.thuong-quan-ly.san-pham.show._grid_loai_quan_ly',[
                    'thuongSanPhamQuanLy'=>$thuongSanPhamQuanLy,
                    'dsLoaiSanPhamQuanLy' => $dsLoaiSanPhamQuanLy
                    ])
            </div>
            <div class="col-12">
                @include('front.thuong-quan-ly.san-pham.show._grid_don_duoc_thuong',[
                    'thuongSanPhamQuanLy'=>$thuongSanPhamQuanLy,
                    'dsSanPhamThuong' => $dsSanPhamThuong
                    ])
            </div>
        </div>
    </div>
    
</x-dashboard-layout>