<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-dark text-white "> 
    <x-slot name="title">
        <h6 class="text-white">
            Danh sách đơn hàng có sản phẩm quản lý được tính thưởng
        </h6>
    </x-slot>
    <x-slot name="button">
      
    </x-slot>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã đơn hàng</th>
                <th>Sản phẩm thưởng</th>
                <th>Danh mục sản phẩm</th>
                <th>Số tiền để tính thưởng</th>
                <th>Số tiền được thưởng</th>
                <!-- <th>Hành động</th> -->
            </tr>
        </thead>
        <tbody>
            @forelse($dsThuongSanPhamQuanLy as $index=>$sanPham) 
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{!!$sanPham->donHang->showLink()!!}</td>
                    <td>{{$sanPham->danhMucSanPham->ten_san_pham}}</td>
                    <td>{{$sanPham->danhMucSanPham->loaiSanPham->name}}</td>
                    <td style="text-align:right">{{thuGonSoLe($sanPham->so_tien_tinh_thuong)}}đ</td>
                    <td style="text-align:right;font-weight:bold" class="text-success">{{thuGonSoLe($sanPham->so_tien_tinh_thuong * $thuongSanPhamQuanLy->tiLeTinhThuongCuaNhanVien())}}đ ({{$thuongSanPhamQuanLy->tiLeTinhThuongCuaNhanVien()*100}}%)</td>
                    <!-- <td>Hành động</td> -->
                </tr>
            @empty
                <tr>
                    <th colspan="6">Không có đơn hàng nào được thưởng</th>
                </tr> 
            @endforelse 
            <tr class="bg-secondary">
                <th colspan="4" style="text-align:center" class="text-white">Tổng cộng</th>
                <th style="text-align:right" class="text-white">{{thuGonSoLe($dsThuongSanPhamQuanLy->sum('so_tien_tinh_thuong'))}}đ</th>
                <th style="text-align:right;font-weight:bold" class="text-white">{{thuGonSoLe($dsThuongSanPhamQuanLy->sum('so_tien_tinh_thuong')*$thuongSanPhamQuanLy->tiLeTinhThuongCuaNhanVien(),0)}}đ ({{$thuongSanPhamQuanLy->tiLeTinhThuongCuaNhanVien()*100}}%)</th>
                <!-- <th></th> -->
            </tr>
        </tbody>
    </table>
</x-simple-card>