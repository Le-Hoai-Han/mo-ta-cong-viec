


<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-gradient-success text-white "> 
    <x-slot name="title"><h6 class="text-white">
        Thông tin số tiền thưởng
    </h6></x-slot>
    <x-slot name="button">
        
    </x-slot>
    <table class="table align-items-center mb-0 table-borderless table-detail">
        <tbody>
            <tr>
                <th>Loại sản phẩm</th>
                <td>{{$soTienThuongKyThuat->mo_ta}}</td>                    
            </tr>
            <tr>
                <th>Tiền thưởng cơ bản</th>
                <td>{{thuGonSoLe($soTienThuongKyThuat->tien_thuong_co_ban)}}</td>                    
            </tr>
            <tr>
                <th>Tiền thưởng vượt mức</th>
                <td>{{thuGonSoLe($soTienThuongKyThuat->tien_thuong_vuot_muc)}}</td>   
            </tr>
            <tr>
                <th>Số lượng giới hạn</th>
                <td>{{$soTienThuongKyThuat->so_luong_gioi_han}}</td>    
            </tr>
        </tbody>
    </table>
</x-simple-card>


