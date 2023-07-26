<?php 
$current = "ĐƠN HÀNG BÁN - ".$data->ma_don_hang;
$list = [
    route('don-hang.index')=>'Danh sách đơn hàng'
]
?>
<x-dashboard-layout :list="$list" :current="$current">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="title_dhb">ĐƠN HÀNG BÁN - {{$data->ma_don_hang}}</h4>
                </div>
                <div class="card-body over-flow-y">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                        </div><br>
                    @endif
                            
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                        <div>
                            
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th colspan="2">Id: <span class="dmsp_text">{{$data->id}}</span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="1">Tên khách hàng:  <span class="dmsp_text">{{($data->khachHang != null)?$data->khachHang->ten_khach_hang:'(Chưa cập nhật)'}}</span></th>
                                        <th colspan="1">Tên người tạo:  <span class="dmsp_text">{{$data->ten_nguoi_tao}}</span></th>
                                    </tr>

                                    <tr>
                                        <th>Doanh số:  <span class="dmsp_text">{{number_format($data->doanh_so)}} VNĐ</span></th>
                                 
                                        <th>Doanh thu:  <span class="dmsp_text">{{number_format($data->doanh_thu)}} VNĐ</span></th>
                                    <tr>    
                                        <th colspan="">Trạng thái:  <span class="dmsp_text">
                                            
                                            {!!$data->getTrangThaiBadge()!!}                                            

                                            {!!$data->daThanhToanBadge()!!}

                                            {!!$data->duocTinhThuongBadge()!!}
                                            
                                            {!!$data->getNoXauBadge()!!}
                                        </span></th>
                                    </tr>
                                    <tr>

                                        
                                        <th>Ngày tạo:  
                                            <span class="dmsp_text">
                                                {{formatNgayDMY($data->ngay_tao_don,'Chưa cập nhật')}}
                                            </span>
                                        </th>
                                        <th>Ngày cập nhật:   
                                        
                                            <span class="dmsp_text">
                                                {{formatNgayDMY($data->updated_at,'Chưa cập nhật')}}
                                            </span>
                                       
                                        </th>
                                    </tr>
                                    <tr>

                                        
                                        <th>Ngày nghiệm thu:  
                                            <span class="dmsp_text">
                                                {{formatNgayDMY($data->ngay_nghiem_thu,'Chưa cập nhật')}}
                                            </span>
                                        </th>
                                        <th>Số ngày tính công nợ:<span class="dmsp_text"> {{$data->so_ngay_tinh_cong_no}} ngày</span></th>
                                    </tr>
                                    <tr>
                                    <th>Ngày bắt đầu tính thưởng: 
                                        <span class="dmsp_text">
                                            {{formatNgayDMY($data->ngay_bat_dau_tinh_thoi_han,"Chưa cập nhật")}}
                                        </span>
                                    </th>
                                    <th>Ngày kết thúc tính thưởng:  
                                        <span class="dmsp_text">
                                            {{formatNgayDMY($data->ngay_ket_thuc_tinh_thuong,'Chưa cập nhật')}}
                                        </span>
                                    </th>

                                    </tr>
                                    <?php /*
                                    <tr>
                                        <th>Số ngày tính công nợ:<span class="dmsp_text"> {{$data->so_ngay_tinh_cong_no}} ngày</span></th>
                                        <th>Phí giao hàng:<span class="dmsp_text"> {{number_format($data->phi_giao_hang)}} VNĐ</span></th>
                                    
                                    </tr>
                                    <tr>
                                        <th>Tổng chiết khấu:<span class="dmsp_text"> {{$data->tong_chiet_khau}}</span></th>
                                        <th>Tổng thuế VAT:<span class="dmsp_text"> {{number_format($data->tong_vat)}} VNĐ   </span></th>
                                    </tr>
                                   
                                    <tr>
                                        <th>Nguồn đơn hàng:
                                            <span class="dmsp_text"> {!!$data->nguonDonHangBadge()!!}</span>
                                        </th>
                                   
                                        <th>Loại đơn hàng:
                                            <span class="dmsp_text"> {!!$data->loaiDonHangBadge()!!}</span>
                                        </th>
                                    </tr>*/?>
                                    <tr>
                                        <th>Chi phí phát sinh:
                                            <span class="dmsp_text"> {{thuGonSole($data->chi_phi_phat_sinh+$data->chi_phi_khac)}} VNĐ</span>
                                        </th>
                                        <th>Quỹ rủi ro:
                                            <span class="dmsp_text"> {{thuGonSole($data->quy_rui_ro)}} VNĐ</span>
                                        </th>
                                        
                                    </tr>
                                    <tr>
                                        <th>Phí vận chuyển của đơn hàng (khách trả):
                                            <span class="dmsp_text"> {{thuGonSole($data->phi_van_chuyen_cua_don_hang)}} VNĐ</span>
                                        </th>
                                        <th>Tiền thưởng đơn hàng:
                                            <span class="dmsp_text"> {{thuGonSole($data->tien_thuong_don_hang)}} VNĐ</span>
                                        </th>
                                    </tr>
                                
                                    
                                </tbody>
                                                
                              
                                    
                            </table>
                            @if(auth()->user()->can('edit_orders'))
                            <a href="{{route('don-hang.edit',$data)}}" class="btn btn-md btn-primary mb-2"><i class="glyphicon glyphicon-edit"></i> Cập nhật</a>
                            @endif
                            
                            <x-base-link :route="route('donhang.tinh',$data)" colorClass="warning" icon="calculator" label="Kiểm tra tính thưởng" />
                            @can('view_noxaus')
                                @if($data->coLichSuNoXau()) 
                                    <x-base-link :route="$data->linkNoXau()" colorClass="danger" icon="money-check-alt" label="Xem thông tin nợ xấu" />
                                @endif
                            @endcan
                            <x-link-quay-ve :route="route('don-hang.index')" label="Quay về" />
                        </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-7">
                @include('donhang.sanpham._index',[
                    'donHang'=>$data                        
                ])
        </div>
        <div class="col-12 col-md-5">
                @include('donhang.thanhtoan._index',[
                    'donHang'=>$data    
                ])
        </div>
        @if($data->thuongKyThuatDonHang->isNotEmpty())
        <div class="col-12">
            @include('run.donhang._thong_tin_thuong_ky_thuat',[
                    'donHang'=>$data,
                    'dsThuongKyThuat'=>$data->thuongKyThuatDonHang    
                ])
        </div>
        @endif
    </div>

   
    
</x-dashboard-layout>
