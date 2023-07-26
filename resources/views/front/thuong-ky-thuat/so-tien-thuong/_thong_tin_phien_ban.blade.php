<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-dark text-white "> 
    <x-slot name="title"><h6 class="text-white">
        Thông tin phiên bản
    </h6></x-slot>
    <x-slot name="button">
    </x-slot>
    <table class="table align-items-center mb-0 table-borderless table-detail">
        <tbody>            
            <tr>
                <th>Trạng thái</th>
                <td>@if($soTienThuongKyThuat->dang_su_dung)
                    <span class="badge bg-gradient-primary">Đang sử dụng</span>
                    @else 
                    <span class="badge bg-gradient-warning">Ngừng sử dụng</span>
                    @endif
                </td>                    
            </tr>
            <tr>
                <th>Phiên bản</th>
                <td>
                    <span class="badge bg-gradient-success">{{$soTienThuongKyThuat->phien_ban}}</span>
                    
                </td>                    
            </tr>
            @if($soTienThuongKyThuat->id_phien_ban_cu)
            <tr>
                <th>Phiên bản cũ</th>
                <td><a href="{{route('thuong-ky-thuat.so-tien-thuong.show',$soTienThuongKyThuat->phienBanCu)}}">{{$soTienThuongKyThuat->phienBanCu->phien_ban}}</a></td>                    
            </tr>
            @endif

            @if($soTienThuongKyThuat->phienBanMoi)
            <tr>
                <th>Phiên bản mới</th>
                <td><a href="{{route('thuong-ky-thuat.so-tien-thuong.show',$soTienThuongKyThuat->phienBanMoi)}}">{{$soTienThuongKyThuat->phienBanMoi->phien_ban}}</a></td>                    
            </tr>
            @endif
        </tbody>
    </table>
</x-simple-card>
