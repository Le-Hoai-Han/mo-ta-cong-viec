<x-simple-card extClass="mt-3" headerClass="bg-secondary text-white " >
    @if(Session::has('error'))
    <div style="color:white;width: fit-content" class="alert alert-danger">{{Session::get('error')}}</div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-success" style="width: fit-content;color:#fff">{{Session::get('success')}}</div>
    @endif 
    <x-slot name="title"><h6 class="text-white" id="thuong-mo-moi">Thưởng mở mới</h6></x-slot>
    {{-- @if(auth()->user()->can('edit_orders'))
        @if($thoiGianHienTai == date('Y-m-%'))
    <x-slot name="button">
    <a href="{{route('donHangTMM.capNhatTatCa',['idThuongNhanVien'=>$thuongNhanVien->id])}}/#thuong-mo-moi" class="btn btn-warning btn-md mb-2" type="button" id="button-tong-thuong">
        <div class="d-flex align-items-center">
            <span class='material-icons'>sync</span>
            Cập nhật
        </div>
    </a>
    </x-slot>
        @endif
    @endif --}}
    <table class="table table-bordered" id="table-chi-tieu ">
        <thead class="bg-secondary text-white align-middle table-dark ">
            <tr>                                 
                <th>Mã ĐH</th>
                <th>Trạng thái</th>              
                <th>Mã khách hàng</th>
                <th>Tiền thưởng<br>mở mới</th>
                <th style="text-align:center">Ngày tạo hàng</th>
                <th style="text-align:center">Ngày bắt đầu thưởng/<br>Ngày kết thúc thưởng</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dsDonHang as $donHang)
                <tr>
                    <th><a href="{{route('don-hang.show',$donHang->donHang->id)}}">
                            {{$donHang->donHang->ma_don_hang}}
                        </a></th>
                    <td style="text-align:center">
                       {!! $donHang->donHang->daThanhToanBadge() !!}<br>
                    </td>
                       
                    </th>
                    <th>{!!$donHang->TMMDonHangKhachHang->khachHang->ma_khach_hang!!}</th>
                    <td>{{thuGonSoLe($donHang->so_tien_thuong)}}</td>
                    <td>{{formatNgayDMY($donHang->donHang->ngay_tao_don)}}</td>
                    <td><span style="color:green">{{formatNgayDMY($donHang->TMMDonHangKhachHang->ngay_bat_dau)}}</span> <br><span style="color: crimson">{{formatNgayDMY($donHang->TMMDonHangKhachHang->ngay_ket_thuc)}}</span> </td>
                    <td>
                        <a href="{{route('donHangTMM.capNhat',['idDonHangThuongMoMoi'=>$donHang->id])}}" class="btn btn-warning btn-md mb-2" type="button" id="">              
                                <span class='material-icons'>sync</span>
                        </a>
                    </td>

                </tr>
                @endforeach 
                @if($thuongNhanVien->nhanVien->laQuanLy() && $dsDonHang->count() > 0)
                <tr class="bg-secondary text-white align-middle table-striped">
                    <th colspan='3'>Tổng tiền thưởng cá nhân</th>
                    <th>{{thuGonSoLe($dsDonHang->sum('so_tien_thuong'))}}</th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                @endif
        </tbody>
        @if($thuongNhanVien->nhanVien->laQuanLy() && $soTienThuongMoMoiThuocTeam > 0)
        <tbody class="bg-secondary text-white align-middle table-dark">
            <tr>                                 
                <th colspan="7">Đơn hàng thuộc nhóm quản lý</th>
            </tr>
        </tbody>
        <tbody>
            @foreach($dsDonHangThuocNhomQuanLy as $donHang)
                <tr>
                    <th><a href="{{route('don-hang.show',$donHang->donHang->id)}}">
                            {{$donHang->donHang->ma_don_hang}}
                        </a></th>
                    <td style="text-align:center">
                       {!! $donHang->donHang->daThanhToanBadge() !!}<br>
                    </td>
                       
                    </th>
                    <th>{!!$donHang->TMMDonHangKhachHang->khachHang->ma_khach_hang!!}</th>
                    <td>{{thuGonSoLe($donHang->so_tien_thuong)}}</td>
                    <td>{{formatNgayDMY($donHang->donHang->ngay_tao_don)}}</td>
                    <td><span style="color:green">{{formatNgayDMY($donHang->TMMDonHangKhachHang->ngay_bat_dau)}}</span> <br><span style="color: crimson">{{formatNgayDMY($donHang->TMMDonHangKhachHang->ngay_ket_thuc)}}</span> </td>

                </tr>
            @endforeach 
            @if($thuongNhanVien->nhanVien->laQuanLy() && $soTienThuongMoMoiThuocTeam > 0)
            <tr class="bg-secondary text-white align-middle table-striped">
                <th colspan='3'>Tổng tiền thưởng của nhóm</th>
                <th>{{thuGonSoLe($soTienThuongMoMoiThuocTeam)}} * 30% = {{thuGonSoLe($soTienThuongMoMoiThuocTeam *0.3)}}</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            @endif
            @if($dsDonHangThuocNhomQuanLy->isEmpty() && $dsDonHang->isEmpty())
            <tr>
                <th colspan='7'>Không có đơn hàng nào</th>
            </tr>
            @endif
        </tbody>
        @endif
        <tfoot class="bg-secondary text-white align-middle table-dark">
            <tr>
                <th colspan='3'>Tổng cộng</th>
                <th>{{thuGonSoLe($soTienThuongMoMoiThuocTeam *0.3 + $dsDonHang->sum('so_tien_thuong'))}}</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
</x-simple-card>