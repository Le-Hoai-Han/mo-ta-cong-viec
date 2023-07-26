<div class="col-xs-12">
    <x-simple-card extClass="mt-3" headerClass="bg-dark text-white "> 
        <x-slot name="title"><h5 class="text-white mb-3">Thông tin đơn hàng</h5></x-slot>
        <x-slot name="button">
            <?php 
                $route=route('no-xau.index');
                $routeNhanVien = route('nhanvien.show',['nhanVien'=>$donHang->nhanVien]);
            ?>
            <x-link-quay-ve :route="$route" label="Quay về" />
            <x-base-link :route="$routeNhanVien" label="Xem nhân viên" colorClass="primary" icon="user"/> 
            <a href="{{route('don-hang.show',['don_hang'=>$donHang])}}" class="btn btn-info btn-md mb-2">
                <i class="fas fa-list" aria-hidden="true"></i> Xem đơn hàng
            </a>
        </x-slot>

        <table class="table table-borderless">
            <tbody>
                <tr>
                    <th>Mã đơn hàng: <span class="dmsp_text">{{$donHang->ma_don_hang}}</span></th>
                    <th>Trạng thái:  <span class="dmsp_text">
                        
                        {!!$donHang->getTrangThaiBadge()!!}                                            

                        {!!$donHang->daThanhToanBadge()!!}

                        {!!$donHang->duocTinhThuongBadge()!!}
                        
                        {!!$donHang->getNoXauBadge()!!}
                    </span></th>
                </tr>

                <tr>
                    <th colspan="1">Tên khách hàng:  <span class="dmsp_text">{{($donHang->khachHang != null)?$donHang->khachHang->ten_khach_hang:'(Chưa cập nhật)'}}</span></th>
                    <th colspan="1">Tên người tạo:  <span class="dmsp_text">{{$donHang->ten_nguoi_tao}}</span></th>
                </tr>

                <tr>
                    <th>Doanh thu:  <span class="dmsp_text">{{number_format($donHang->doanh_thu)}} VNĐ</span></th>
                    <th>Số tiền đã thanh toán:  <span class="dmsp_text">{{number_format($donHang->thanhToanThuocDonHang->sum('so_tien_thanh_toan'))}} VNĐ</span></th>
                </tr>
                
                <tr>

                    
                    <th>Ngày tạo:  
                        <span class="dmsp_text">
                            {{formatNgayDMY($donHang->ngay_tao_don,'Chưa cập nhật')}}
                        </span>
                    </th>
                    <th>Ngày cập nhật:   
                    
                        <span class="dmsp_text">
                            {{formatNgayDMY($donHang->updated_at,'Chưa cập nhật')}}
                        </span>
                    
                    </th>
                </tr>
                
            </tbody>
                            
            
                
        </table>
</x-simple-card>