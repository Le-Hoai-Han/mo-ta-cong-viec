<?php 
$current = "Thêm thông tin thanh toán";
$list = [
    route('don-hang.index')=>'Danh sách đơn hàng',
    route('don-hang.show',['id'=>$donHang->id])=>$donHang->ma_don_hang
]
?>
<x-dashboard-layout :list="$list" :current="$current">
    <div class="row">
        <div class="col-12">
            <div class="card p-2">
                <form action="{{route('donhang.luuThanhToan',['donHang'=>$donHang])}}" method="POST">

                    @csrf
                    <div class="card-header">
                        <div class="row rounded">
                            <div class="col-6">
                                <h6 class="col">Thông tin thanh toán</h6>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>     
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="so_tien_thanh_toan" class="form-control-label">Số tiền thanh toán</label>
                                    <input type="number" class="form-control" name="so_tien_thanh_toan" id="so_tien_thanh_toan" value="{{old('so_tien_thanh_toan')}}"/>
                                    @error('so_tien_thanh_toan')
                                        <span class="help text-danger"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="ngay_thanh_toan" class="form-control-label">Ngày thanh toán</label>
                                    <input type="text" class="form-control datepicker" value="{{old('ngay_thanh_toan',date('d/m/Y'))}}" placeholder="dd/mm/yyyy" name="ngay_thanh_toan" id="ngay_thanh_toan" />
                                    @error('ngay_thanh_toan')
                                        <span class="help text-danger"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="">Thông tin đơn hàng</h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Id: <span class="dmsp_text">{{$donHang->id}}</span></th>
                                <th>Ngày bắt đầu tính thời hạn: <span class="dmsp_text">{{date('d-m-Y',strtotime($donHang->ngay_bat_dau_tinh_thoi_han))}}</span></th>
                            </tr>

                            <tr>
                                <th>Tên người tạo:  <span class="dmsp_text">{{$donHang->ten_nguoi_tao}}</span></th>
                                <th>Ngày kết thúc tính thưởng:  <span class="dmsp_text">{{date('d-m-Y',strtotime($donHang->ngay_ket_thuc_tinh_thuong))}}</span></th>
                            </tr>

                            <tr>
                                <th>Doanh số:  <span class="dmsp_text">{{number_format($donHang->doanh_so)}} VNĐ</span></th>
                                <th>Được tính thưởng:  <span class="dmsp_text">{{$donHang->duoc_tinh_thuong}} </span></th>
                            </tr>
                            <tr>
                                <th>Doanh thu:  <span class="dmsp_text">{{number_format($donHang->doanh_thu)}} VNĐ</span></th>
                                <th>Trạng thái:  <span class="dmsp_text">@if($donHang->trang_thai ==$donHang::TT_MOI)
                                    Chưa duyệt
                                    @elseif($donHang->trang_thai == $donHang::TT_DUYET)
                                        Đã duyệt
                                        @elseif($donHang->trang_thai ==$donHang::TT_THANH_TOAN)
                                        Đã thanh toán 
                                        @elseif($donHang->trang_thai ==$donHang::TT_HUY)
                                        Đã hủy
                                    @endif
                                </span></th>
                            </tr>
                            <tr>

                                <th>Đã thanh toán:  <span class="dmsp_text">
                                    @if($donHang->da_thanh_toan == 1)
                                        Đã thanh toán
                                    @else
                                        Chưa thanh toán
                                    @endif
                                    </span>
                                </th>
                                <th>Ngày tạo:  @if($donHang->ngay_tao_don !=null)
                                    <span class="dmsp_text">{{date("d-m-Y", strtotime($donHang->ngay_tao_don))}}</span>
                                    @else
                                
                                    @endif</th>
                                
                            </tr>
                            <tr>
                                <!-- <th>Ngày tạo đơn:  <span class="dmsp_text">{{$donHang->ngay_tao_don}}</span></th> -->
                            
                            </tr>
                            <tr>
                                <th>Phí giao hàng:<span class="dmsp_text"> {{number_format($donHang->phi_giao_hang)}} VNĐ</span></th>
                                
                                <th>Cập nhật:   @if($donHang->updated_at !=null)
                                    <span class="dmsp_text">{{$donHang->updated_at->format('d-m-Y')}}</span>
                                    @else
                                    
                                    @endif
                                </th>

                            
                                </tr>
                            <tr>
                                <th>Tổng chiết khấu:<span class="dmsp_text"> {{$donHang->tong_chiet_khau}} VNĐ</span></th>
                                <th>Tổng thuế VAT:<span class="dmsp_text"> {{number_format($donHang->tong_vat)}} VNĐ   </span></th>
                            </tr>
                            
                        </tbody>                                        
                            
                    </table>
                </div>
            </div>

            
        </div>
    </div>
</x-dashboard-layout>