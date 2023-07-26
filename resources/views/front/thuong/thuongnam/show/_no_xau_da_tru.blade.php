<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-danger text-white "> 
<x-slot name="title"><h6 class="text-white">
        Thông tin khoản nợ đã thanh toán (đã trừ)
    </h6></x-slot>

    <div class="table-responsive">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Ngày bắt đầu</th>
                    <th>Tiền nợ</th>                       
                    <th>Số tiền đã trừ trong năm</th>                 
                    <th>Tổng số tiền đã trả</th>
                    <th>Tổng số tiền còn lại</th> 
                    <th>Hành động</th>
                </tr>
                @forelse($dsNoXauDaTru as $index=>$noXauDaTru)
                <?php 
                    $noXau = $noXauDaTru->noXau;
                ?>
                <tr>
                    <th>{{$index+1}}</th>
                    <td>
                        <a href="{{route('don-hang.show',['don_hang'=>$noXau->donHang])}}" class='text-bold'>{{$noXau->donHang->ma_don_hang}}</a>
                    </td>
                    <td>{{formatNgayDMY($noXau->ngay_bat_dau)}}</td>
                    <td class="text-warning text-bold">{{thuGonSoLe($noXau->tong_so_tien)}}đ</td>                    
                    <td class="text-danger">{{thuGonSoLe($noXauDaTru->so_tien)}}đ</td>
                    <td class="text-success">{{thuGonSoLe($noXau->tien_da_tru)}}đ</td>
                    <td class="text-primary">{{thuGonSoLe($noXau->tien_con_lai)}}đ</td>
                    <td>                        
                        <x-link-xem label="" :route="route('no-xau.show',['noXau'=>$noXauDaTru->noXau])" />

                    </td>
                </tr>
                @empty 
                <tr>
                    <th>Chưa có thông tin thanh toán nào</th>
                </tr>
                @endforelse
            </thead>
        </table>
    </div>
</x-simple-card>