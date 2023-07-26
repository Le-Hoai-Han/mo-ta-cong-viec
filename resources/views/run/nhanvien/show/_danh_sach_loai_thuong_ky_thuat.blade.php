<x-simple-card extClass="mt-3" headerClass="bg-gradient-primary text-white ">
    <x-slot name="title">
        <h5 class="text-white mb-0"><h6 class="text-white mb-3">Loại hình thưởng</h6>
    </x-slot>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>STT</th>                    
                    <th>
                        Tên loại
                    </th>                                            
                    <th >Mô tả</th> 
                </tr>
            </thead>
            <tbody>
                @forelse($dsLoaiThuongKyThuat as $index => $loaiThuong)
                    <tr>
                        <td style="text-align:center">{{$index+1}}</td>                    
                                                                                    
                        <td>
                            {{$loaiThuong->ten_loai}}
                        </td>                                            
                        <td >{{$loaiThuong->mo_ta}}</td> 
                    
                    </tr>
                @empty 
                    <tr>
                        <td colspan="3">Chưa có sản phẩm quản lý</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        

    </div>
</x-simple-card>
