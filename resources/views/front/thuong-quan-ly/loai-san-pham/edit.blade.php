<?php 
$current = "Thêm loại sản phẩm thuộc nhóm quản lý";
$list = [    
    route('thuong-quan-ly.loai-san-pham.index')=>'Danh mục loại sản phẩm có nhóm quản lý'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="col-12 col-md-6">
        <form name="frm_update_loai_san_pham_quan_ly" method="POST" action="{{route('thuong-quan-ly.loai-san-pham.update',$loaiSanPhamQuanLy)}}" id="frm_update_loai_san_pham_quan_ly" >
            @method('PUT')
            @include('front.thuong-quan-ly.loai-san-pham._form_loai_san_pham_quan_ly_no_button',[
                    'loaiSanPhamQuanLy' => $loaiSanPhamQuanLy,
                    'buttonLabel' => 'Lưu',
                    'dsNhomNhanVien' => $dsNhomNhanVien,
                    'dsLoaiSanPham' => $dsLoaiSanPham
                ])
        </form>
    </div>
</x-dashboard-layout>