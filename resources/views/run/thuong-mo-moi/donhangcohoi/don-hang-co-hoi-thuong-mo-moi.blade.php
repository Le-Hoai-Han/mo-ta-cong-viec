<x-simple-card extClass="mt-3" headerClass="bg-secondary text-white ">
    <x-slot name="title"><h6 class="text-white">Đơn hàng cơ hội thưởng mở mới</h6></x-slot>
    <table class="table table-bordered" id="table-chi-tieu ">
        <thead class="bg-secondary text-white align-middle table-dark ">
            <tr>                                 
                <th>Mã ĐH</th>
                <th>Trạng thái</th>
                <th style="text-align:center">Doanh thu</th>
                <th style="text-align:center">Ngày đặt hàng </th>             
                <th style="text-align:center">Thanh toán </th>             
                <th style="text-align:center">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dsDonHang as $donHang)
                <tr>
                    <th><a href="{{route('don-hang.show',['don_hang'=>$donHang])}}">
                            {{$donHang->ma_don_hang}}
                        </a></th>
                    <td style="text-align:center">
                       {!! $donHang->getTrangThaiBadge() !!}<br>
                       {!! $donHang->daThanhToanBadge() !!}
                    </td>
                       
                    </th>
                    <td>{{thuGonSoLe($donHang->doanh_thu)}}</td>
                    <td>{{$donHang->ngay_tao_don}}</td>
                    <td>{!!$donHang->thongTinThanhToan()!!}</td>
                    {{-- @if($donHang->da_thanh_toan == 2)    --}}
                    <td style="text-align:center"><a href="{{route('donHang.__updateThanhToan',$donHang)}}" class='btn btn-sm btn-warning'><span class="material-icons">change_circle</span></a></td>
                    {{-- @endif --}}
                </tr>
            
            @empty
            <tr>
                <th colspan='6'>Không có đơn hàng nào</th>
            </tr>
            @endforelse
        </tbody>
    </table>
</x-simple-card>