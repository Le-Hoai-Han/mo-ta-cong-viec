<x-simple-card extClass="mt-3" headerClass="bg-dark text-white"> 
    <x-slot name="title"><h6 class="text-success">Thưởng kỹ thuật</h6></x-slot>
    <x-slot name="button">
        <a href="{{route('thuong-ky-thuat.kiem-tra-don-hang',['donHang'=>$donHang])}}" class="btn btn-success mb-2">Cập nhật</a>
    </x-slot>
    @csrf
    <div class="row">
        <table>
            <thead>
                <tr>
                    <th>Loại</th>
                    <th>Mô tả</th>
                    <th>Số tiền thưởng</th>
                    <th>Ngày cập nhật</th>
                </tr>
            </thead>
            <tbody>
                @forelse($dsThuongKyThuat as $thuongKyThuat)
                <tr>
                    <td>{{$thuongKyThuat->loaiThuongKyThuat->ten_loai}}</td>
                    <td>{!!$thuongKyThuat->mo_ta!!}</td>
                    <td>{{thuGonSoLe($thuongKyThuat->so_tien_thuong)}}đ</td>
                    <td>{{$thuongKyThuat->ngay_cap_nhat}}</td>
                </tr>
                @empty
                <tr>
                    <td colspan='4'>Không tìm thấy thông tin thưởng kỹ thuật</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-simple-card>