<x-simple-card extClass="mt-3" headerClass="bg-secondary text-white ">
    <x-slot name="title"><h6 class="text-white">Đơn hàng trong tháng {{$thangNamThuong->thang}} năm {{$thangNamThuong->nam}}</h6></x-slot>
    @if(auth()->user()->can('edit_orders'))
    <x-slot name="button">
    <!-- <a href="{{route('nhanVien.capNhatThuongDonHang',['thuongNhanVien'=>$thuongNhanVien])}}" class="btn btn-warning btn-md mb-2" type="button" id="button-tong-thuong">
        <div class="d-flex align-items-center">
            <span class='material-icons'>edit_note</span>
            Cập nhật
        </div>
    </a> -->
    </x-slot>
    @endif
    <table class="table table-bordered" id="table-chi-tieu ">
        <thead class="bg-secondary text-white align-middle table-dark ">
            <tr>                                 
                <th>Mã ĐH</th>
                <th>Trạng thái</th>
                <th style="text-align:center">Doanh thu</th>
                <th style="text-align:center">Thanh toán </th>                
                <th style="text-align:center">Số tiền tính thưởng</th>
                <th>Tiền thưởng<br>đơn hàng</th>
                <th style="text-align:center">Ngày đặt hàng/<br>Ngày xuất hóa đơn</th>
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
                       {!! $donHang->duocTinhThuongBadge() !!}
                    </td>
                       
                    </th>
                    <td>{{thuGonSoLe($donHang->doanh_thu)}}</td>
                    <td>{!!$donHang->thongTinThanhToan()!!}</td>
                    <td>{{thuGonSoLe($donHang->so_tien_tinh_thuong)}}</td>
                    
                    <td>{{thuGonSoLe($donHang->tien_thuong_don_hang)}}</td>
                    <td>{{formatNgayDMY($donHang->ngay_tao_don)}}<br>{{formatNgayDMY($donHang->ngay_xuat_hoa_don,"Chưa xuất HĐ")}}</td>

                </tr>
            @empty 
                <tr>
                    <th>Không có ghi nhận đơn hàng nào trong tháng</th>
                </tr>
            @endforelse  
        </tbody>
        <tfoot class="bg-secondary text-white align-middle table-dark ">
            <tr>
                <th colspan='2'>Tổng cộng</th>
                <th>{{thuGonSoLe($dsDonHang->sum('doanh_thu'))}}</th>
                <th></th>
                <th>{{thuGonSoLe($dsDonHang->sum('so_tien_tinh_thuong'))}}</th>
                <th>{{thuGonSoLe($dsDonHang->sum('tien_thuong_don_hang'))}}</th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</x-simple-card>