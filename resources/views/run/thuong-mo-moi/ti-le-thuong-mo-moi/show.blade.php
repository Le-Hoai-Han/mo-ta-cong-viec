<?php 
$current = "ĐƠN HÀNG THƯỞNG MỞ MỚI - ".$donHang->donHang->ma_don_hang;
$list = [
    route('don-hang.index')=>'Danh sách đơn hàng'
]
?>
<x-dashboard-layout :list="$list" :current="$current">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="title_dhb">ĐƠN HÀNG THƯỞNG MỞ MỚI - {{$donHang->donHang->ma_don_hang}}</h4>
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
                                        <th colspan="2">Id: <span class="dmsp_text">{{$donHang->id}}</span></th>
                                    </tr>

                                    <tr>
                                        <th colspan="1">Tên khách hàng:  <span class="dmsp_text">{{($donHang->TMMDonHangKhachHang->khachHang != null)? $donHang->TMMDonHangKhachHang->khachHang->ten_khach_hang:'(Chưa cập nhật)'}}</span></th>
                                        <th colspan="1">Tên người tạo:  <span class="dmsp_text">{{$donHang->donHang->ten_nguoi_tao}}</span></th>
                                    </tr>

                                    <tr>
                                        {{-- <th>Doanh số:  <span class="dmsp_text">{{number_format($donHang->$donHang->doanh_so)}} VNĐ</span></th> --}}
                                 
                                        {{-- <th>Doanh thu:  <span class="dmsp_text">{{number_format($donHang->$donHang->doanh_thu)}} VNĐ</span></th> --}}
                                    <tr>    
                                        <th>Ngày tạo:  
                                            <span class="dmsp_text">
                                                {{formatNgayDMY($donHang->donHang->ngay_tao_don,'Chưa cập nhật')}}
                                            </span>
                                        </th>
                                        <th colspan="">Trạng thái:  <span class="dmsp_text">
                                            {!!$donHang->donHang->daThanhToanBadge()!!}
                                        </span></th>
                                    </tr>
                                   
                                    <tr>
                                        <th>Tiền thưởng mở mới:
                                            <span class="dmsp_text"> {{thuGonSole($donHang->so_tien_thuong)}} VNĐ</span>
                                        </th>
                                    </tr>
                                
                                    
                                </tbody>
                                
                                    
                            </table>
                            @if(auth()->user()->can('edit_orders'))
                            {{-- <a href="{{route('don-hang.edit',$data)}}" class="btn btn-md btn-primary"><i class="glyphicon glyphicon-edit"></i> Cập nhật</a> --}}
                            @endif
                            {{-- <a href="{{route('donhang.tinh',$data)}}" class="btn btn-md btn-warning"><i class="glyphicon glyphicon-edit"></i>Kiểm tra tính thưởng </a> --}}

                        </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-8">
                @include('run.thuong-mo-moi.sanphamthuocmomoi.index',[
                    'donHang'=>$donHang                        
                ])
        </div>
        <div class="col-12 col-md-4">
                @include('donhang.thanhtoan._index',[
                    'donHang'=>$donHang->donHang    
                ])
        </div>
    </div>

   
    
</x-dashboard-layout>
