<?php 
$current = "Cập nhật";
$list = [
    route('don-hang.index')=>'Danh sách đơn hàng',
    route('don-hang.show',[
      'don_hang'=>$donHang
    ])=>$donHang->ma_don_hang
]
?>
<x-dashboard-layout :list="$list" :current="$current">
    <div class="row">
        <div class="col-12">
            <form action="{{route('don-hang.update',[
                'don_hang'=>$donHang
                ])}}" method="POST">
                @csrf 
                @method('PUT')
            <div class="card">
                <div class="card-header">
                    <h4 class="title_dhb">Cập nhật đơn hàng {{$donHang->ma_don_hang}}</h4>
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
                        <div class="col-12 col-md-8">
                            
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th colspan="2">
                                            <label>ID</label>
                                            <input type="text" class="form-control" value="{{$donHang->id}}" readonly/>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="2">
                                            <label>Tên người tạo</label>  
                                            <input type="text" class="form-control" value="{{$donHang->ten_nguoi_tao}}" readonly />
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>
                                            <label>Doanh số</label>
                                            <input type="text" class="form-control" value="{{thuGonSole($donHang->doanh_so)}}" name="doanh_so" />
                                        </th>
                                 
                                        <th>
                                            <label>Doanh thu</label> 
                                            <input type="text" class="form-control" value="{{thuGonSole($donHang->doanh_thu)}}" name="doanh_thu"/>
                                        </th>
                                    <tr>    
                                        <th>
                                            <label>Trạng thái đơn hàng</label>
                                            <select name="trang_thai" id="" class="form-control">
                                                @foreach($donHang->danhSachTrangThai as $key=> $item)
                                                <option value="{{$key}}" <?php echo ($donHang->trang_thai == $key ? 'selected' :'' ) ?> >{{$item}}</option>
                                                @endforeach
                                            </select>
                                          
                                        </th>
                                        <th>
                                            <label>Trạng thái thanh toán</label>
                                            <select name="da_thanh_toan" id="" class="form-control">
                                                @foreach($donHang->danhSachTrangThaiThanhToan as $key=> $item)
                                                <option value="{{$key}}" <?php echo ($donHang->da_thanh_toan == $key ? 'selected' :'' ) ?> >{{$item}}</option>
                                                @endforeach
                                            </select>
                                        </th>
                                    </tr>
                                    <tr>

                                        
                                        <th>
                                            <label>Ngày tạo</label>  
                                            <input type="text" class="form-control" value="{{$donHang->ngay_tao_don}}" name="ngay_tao_don" />
                                        </th>
                                        <th>
                                            <label>Số ngày tính công nợ</label>  
                                            <input type="text" class="form-control" value="{{$donHang->so_ngay_tinh_cong_no}}" name="so_ngay_tinh_cong_no" />
                                        </th>
                                        
                                    </tr>
                                    <tr>

                                        
                                        <th>
                                            <label>Ngày nghiệm thu</label>  
                                            <input type="text" class="form-control" value="{{$donHang->ngay_nghiem_thu}}" name="ngay_nghiem_thu" />
                                        </th>
                                        
                                    </tr>
                                  
                                    <tr>
                                        <th>
                                            <label>Nguồn đơn hàng</label>
                                            @foreach($donHang->danhSachNguonDonHang as $id=>$name)
                                            <div class="form-check">
                                                <input 
                                                class="form-check-input" 
                                                type="radio" 
                                                name="la_nguon_marketing" 
                                                id="la_nguon_marketing_{{$id}}" 
                                                <?php
                                                if($donHang->la_nguon_marketing==$id)
                                                    echo "checked"; 
                                                ?>
                                                value="{{$id}}" />
                                                <label class="form-check-label" for="la_nguon_marketing_{{$id}}">
                                                    {{$name}}
                                                </label>
                                            </div>
                                            @endforeach
                                        </th>
                                   
                                        <th>
                                            <label>Loại đơn hàng</label>
                                            @foreach($donHang->danhSachLoaiDonHang as $id=>$name)
                                            <div class="form-check">
                                                <input 
                                                class="form-check-input" 
                                                type="radio" 
                                                name="la_may_thanh_ly" 
                                                id="la_may_thanh_ly_{{$id}}" 
                                                <?php if($donHang->la_may_thanh_ly==$id)
                                                    echo "checked"; ?>
                                                value="{{$id}}" />
                                                <label class="form-check-label" for="la_may_thanh_ly_{{$id}}">
                                                    {{$name}}
                                                </label>
                                            </div>
                                            @endforeach
                                            
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><label>Chi phí phát sinh</label>
                                            <input type="text" class="form-control" value="{{thuGonSole($donHang->chi_phi_phat_sinh)}}" name="chi_phi_phat_sinh"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><label>Quỹ rủi ro</label>
                                            <input type="text" class="form-control" value="{{thuGonSole($donHang->quy_rui_ro)}}" name="quy_rui_ro"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><label>Chi phí vận chuyển của đơn hàng</label>
                                            <input type="text" class="form-control" value="{{thuGonSole($donHang->phi_van_chuyen_cua_don_hang)}}" name="phi_van_chuyen_cua_don_hang"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><label>Tiền thưởng đơn hàng:</label>
                                            <input type="text" class="form-control" value=" {{thuGonSole($donHang->tien_thuong_don_hang)}}" name="tien_thuong_don_hang" />
                                        </th>
                                    </tr>
                                
                                    
                                </tbody>
                                                
                              
                                    
                            </table>
                            <button class="btn btn-md btn-primary"><i class="glyphicon glyphicon-edit"></i> Cập nhật</button>
                            <a href="{{route('don-hang.show',['don_hang'=>$donHang])}}" class="btn btn-md btn-dark"><i class="glyphicon glyphicon-edit"></i>Hủy </a>

                        </div>
                </div>
            </div>
            </form>
        </div>

     
    </div>

   
    
</x-dashboard-layout>
