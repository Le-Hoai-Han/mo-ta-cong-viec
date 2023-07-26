<x-simple-card extClass="mt-3" headerClass="bg-secondary text-white ">
    <x-slot name="title"><h6 class="text-white">Đơn hàng trong 
        @if($thuongThoiGian->loai==$thuongThoiGian::LOAI_THUONG_QUY) 
        quý 
        @else
        năm 
        @endif</h6></x-slot>
    
    <table class="table table-bordered" id="table-chi-tieu ">
        <thead class="bg-secondary text-white align-middle table-dark ">
            <tr>        
                <th style="width:50px">STT</th>                         
                <th>Mã ĐH</th>
                <th>Trạng thái</th>
                <th style="text-align:center">Doanh thu</th>
                <th style="text-align:center">Thanh toán </th>                
                <th>Tiền thưởng<br>đơn hàng</th>
                <th style="text-align:center">Ngày đặt hàng/<br>Ngày xuất hóa đơn</th>
            </tr>
        </thead>
        <tbody>
            @forelse($dsDonHang as $index=>$donHang)
                <tr>
                    <th style="text-align:center">{{$index+1}}</th>
                    <th><a href="{{route('don-hang.show',['don_hang'=>$donHang])}}">
                            {{$donHang->ma_don_hang}}
                        </a></th>
                    <td style="text-align:center">
                       {!! $donHang->getTrangThaiBadge() !!}<br>
                       {!! $donHang->duocTinhThuongBadge() !!}
                    </td>
                       
                    </th>
                    <td>{{thuGonSoLe($donHang->doanh_thu)}}</td>
                    <td>{!!$donHang->thongTinThanhToan()!!}</td>
                    
                    
                    <td>{{thuGonSoLe($donHang->tien_thuong_don_hang)}}</td>
                    <td>{{formatNgayDMY($donHang->ngay_tao_don)}}<br>{{formatNgayDMY($donHang->ngay_xuat_hoa_don,"Chưa xuất HĐ")}}</td>

                </tr>
            @empty
            <tr>
                <th colspan='6'>Không có đơn hàng nào trong tháng</th>
            </tr>
            @endforelse 
        </tbody>
        <tfoot class="bg-secondary text-white align-middle table-dark ">
            <tr>
                <th colspan='3' style="text-align:center">Tổng cộng</th>
                <th>{{thuGonSoLe($dsDonHang->sum('doanh_thu'))}}</th>
                <th></th>
                <th>{{thuGonSoLe($dsDonHang->sum('tien_thuong_don_hang'))}}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</x-simple-card>