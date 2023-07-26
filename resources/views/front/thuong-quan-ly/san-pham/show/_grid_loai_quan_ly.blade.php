<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-dark text-white "> 
    <x-slot name="title">
        <h6 class="text-white">
            Các loại sản phẩm quản lý
        </h6>
    </x-slot>
    <x-slot name="button">
        <a href="{{route('thuong-quan-ly.loai-san-pham.index')}}" class='btn btn-secondary' >
            <i class="fas fa-list" aria-hidden="true"></i>
                Danh sách
            </a> 
        @if(auth()->user()->can('add_quanlysanphams') && !$thuongSanPhamQuanLy->daKhoa())

            <a href="{{route('thuong-quan-ly.loai-san-pham.create')}}" class='btn btn-primary' >
            <i class="fas fa-plus" aria-hidden="true"></i>
                Thêm
            </a>                                                          
                                        
        @endif

    </x-slot>
    <table class="table">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã loại</th>
                <th>Tên loại</th>
            
            </tr>
        </thead>
        <tbody>
            @forelse($dsLoaiSanPhamQuanLy as $index => $loaiSanPham)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$loaiSanPham->code}}</td>
                    <td>{{$loaiSanPham->name}}</td>
                </tr>
            @empty
                <tr>
                    <td colspan='3'>Không có sản phẩm quản lý</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</x-simple-card>