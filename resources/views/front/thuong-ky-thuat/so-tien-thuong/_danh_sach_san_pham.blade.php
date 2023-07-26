


<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-gradient-secondary text-white "> 
    <x-slot name="title"><h6 class="text-white">
        Danh sách sản phẩm được tính
    </h6></x-slot>
    <x-slot name="button">
    <a href="{{route('thuong-ky-thuat.so-tien-thuong.cap-nhat-danh-muc',['soTienThuongKyThuat'=>$soTienThuongKyThuat])}}" class='btn btn-warning'>Cập nhật danh mục</a>
    </x-slot>
    <table class="table align-items-center mb-0 table-borderless">
        <thead>
            <tr>
                <th>Mã sản phẩm</th>

                <th>Tên sản phẩm</th>
            
                <th>Loại sản phẩm</th>
           
                <th>Dòng sản phẩm</th>
           
            </tr>
        </thead>
        <tbody>
            @forelse($dsSanPham as $sanPham)
            <tr>
                <td>{{$sanPham->ma_san_pham}}</td>    
                <td>{{$sanPham->ten_san_pham}}</td>            
                <td>{{($sanPham->id_loai_san_pham)?$sanPham->loaiSanPham->name:"Chưa cập nhật"}}</td>            
                <td>{{$sanPham->dong_san_pham}}</td>                            
                
            </tr>
  
            @empty 
            @endforelse
        </tbody>
    </table>
</x-simple-card>
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