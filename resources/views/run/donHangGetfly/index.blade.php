<?php 
$current = "ĐƠN HÀNG BÁN - ".$data['order_code'];
$list = [
    route('don-hang.index')=>'Danh sách đơn hàng'
]
?>
<x-dashboard-layout :list="$list" :current="$current">
    <div class="row">
    

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="title_dhb">ĐƠN HÀNG BÁN - {{$data['order_code']}}</h4>
                </div>
                <div class="card-body over-flow-y">
                     
                @if(Session::has('error'))
                    <div style="color:white" class="alert alert-danger">{{Session::get('error')}}</div>
                @elseif($message)
                    <div style="color:white" class="alert {{$status}}">{{$message}}</div>
                @endif

                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif 
                    <div>
                        
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <th colspan="2">Id: <span class="dmsp_text">{{$data['order_id']}}</span></th>
                                </tr>
                                <tr>
                                    <th>Doanh số:  <span class="dmsp_text">{{thuGonSoLe($data['doanh_so'])}} VNĐ</span></th>
                                    
                                 
                                    <th>Doanh thu:  <span class="dmsp_text">{{thuGonSoLe($data['amount'])}} VNĐ</span></th>
                                </tr>
                                <tr> 
                                    <th colspan="2">Trạng thái:  <span class="dmsp_text">
                                            <?php
                                            switch ($data['order_status']) {
                                                case 1:
                                                    echo '<span class="badge bg-gradient-warning">Đơn hàng mới</span>';
                                                    break;
                                                case 2:
                                                    echo '<span class="badge bg-gradient-primary">Đã duyệt</span>';
                                                    break;
                                                case 4:
                                                    echo '<span class="badge bg-gradient-secondary">Đã hoàn thành</span>';
                                                    break;
                                                default:
                                                    # code...
                                                    break;
                                            }    
                                            ?>
                                           
                                            @if($tongThanhToan == $data['amount'])
                                            <span class="badge bg-gradient-success">Đã thanh toán đủ</span>
                                            @elseif($tongThanhToan < $data['amount'] && $tongThanhToan > 0)
                                            <span class="badge bg-gradient-warning">Đã thanh toán một phần</span>
                                            @else
                                            <span class="badge bg-gradient-secondary">Chưa thanh toán</span>
                                            @endif
                                        <span class="dmsp_text">
                                        @if($data['order_status'] ==0)
                                        <span class="badge bg-gradient-warning">Đơn hàng mới</span>
                                        @elseif($data['order_status'] ==1)
                                        <span class="badge bg-gradient-primary">Đã duyệt</span>
                                        @elseif($data['order_status'] ==2)
                                        <span class="badge bg-gradient-success">Đã thanh toán</span>
                                        @elseif($data['order_status'] ==4)
                                        <span class="badge bg-gradient-secondary">Đã hoàn thành</span>
                                        @endif
                                        
                                    </span></th>
                                </tr>
                                <tr>

                                    
                                    <th colspan="2">Ngày tạo:  
                                        <span class="dmsp_text">
                                            {{formatNgayDMY($data['order_date'],'Chưa cập nhật')}}
                                        </span>
                                    </th>
                              
                                
                                <tr>
                                        <th>Tổng chiết khấu:<span class="dmsp_text"> {{number_format($data['discount_amount'])}}</span></th>
                                        
                                   
                                    <th>Tổng thuế VAT:<span class="dmsp_text"> {{number_format($data['tong_vat'])}} VNĐ   </span></th>
                                    </tr>
                               
                                
                            </tbody>
                                            
                            
                                
                        </table>
                        @if(auth()->user()->can('edit_orders'))
                            @if($coDonHang == true)
                            <a href="{{route('donHangGetfly.update',$data['order_code'])}}" class="btn btn-md btn-primary"><i class="glyphicon glyphicon-edit"></i> Cập nhật lại đơn hàng</a>
                            @else
                            <a href="{{route('donHangGetfly.store',$data['order_code'])}}" class="btn btn-md btn-primary"><i class="glyphicon glyphicon-edit"></i> Thêm đơn hàng</a>
                            @endif
                        @endif
                        {{-- <a href="{{route('donhang.tinh',$data)}}" class="btn btn-md btn-warning"><i class="glyphicon glyphicon-edit"></i>Kiểm tra tính thưởng </a> --}}

                    </div>
                </div>
            </div>
        </div>

         <div class="col-12 col-md-8">
                @include('run.donHangGetfly.sanPham.index',[
                    'donHang'=>$products                     
                ])
        </div>
       <div class="col-12 col-md-4">
                @include('run.donHangGetfly.thanhToanGetfly.index',[
                    'donHang'=>$payments  
                ])
        </div>
    </div>

   
    
</x-dashboard-layout>
