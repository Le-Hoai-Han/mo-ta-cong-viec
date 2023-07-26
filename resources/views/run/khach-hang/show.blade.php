<?php
$current = 'Khách hàng - ' . $khachHang['ma_khach_hang'];
$list = [
    route('khach-hang.index') => 'Chi tiết khách hàng',
];
?>



<x-dashboard-layout :list="$list" :current="$current">
    
    <div class="row">
        <div class="col-6">
            <x-simple-card extClass="mt-3" headerClass="bg-success text-white "> 
                <x-slot name="title"><h6 class="text-white">Thông tin chính</h6></x-slot>
                <div class="table-responsive">
                    <table class="table table-responsive" id="">
                        <tr>
                            <tr>
                                <th class="col-3" style="text-align: left">ID </th>
                                <th style="vertical-align:middle;text-align:left;font-weight:bold" class="col-9">{{$khachHang['id']}}</th>
                            </tr>
                            <tr>
                                <th class="col-2" style="text-align:left" >Mã khách hàng</th>
                                <th style="vertical-align:middle;text-align:left;font-weight:bold" class="">{{$khachHang['ma_khach_hang']}}</th>
                            </tr>
                            <tr>
                                <th class="col-4" style="text-align:left">Tên khách hàng</th>
                                <th style="vertical-align:middle;text-align:left;font-weight:bold" class="">{{$khachHang['ten_khach_hang']}}</th>
                            </tr>
                            <tr>
                                <th class="col-2" style="text-align:left">Email  </th>
                                <th style="vertical-align:middle; class="">{{ ($khachHang['email'] != null)? $khachHang['email']:'(Chưa cập nhật)' }}</th>
                            </tr>
                            <tr>
                                <th class="col-1" style="text-align:left">Điện thoại</th>                                                                     
                                <th style="text-align:left" class="">{{ $khachHang['dien_thoai'] }}</th>

                            </tr>
                            <tr>
                                <th class="col-2" style="text-align:left">Địa chỉ</th>                                    
                                <th style="text-align:left" class="">{{ ($khachHang['dia_chi'] != null)?$khachHang['dia_chi']:'(Chưa cập nhật)' }}</th>

                            </tr>
                            <tr>
                                <th class="col-1" style="text-align:left">Người phụ trách</th>   
                                <th style="vertical-align:middle;text-align:left;font-weight:bold" class="">{{ $khachHang['nguoi_phu_trach'] }}</th>
                            </tr>
                            <tr>
                                <th class="col-4" style="text-align:left">Nhóm khách hàng</th>
                                <th style="vertical-align:middle;text-align:left;font-weight:bold" class="">{{$khachHang['nhom_khach_hang']}}</th>
                                
                            </tr>

                            <tr>
                                <th class="col-3" style="text-align:left">Nguồn khách hàng</th>                                  
                                <th style="vertical-align:middle;text-align:left;font-weight:bold" class="">{{$khachHang['nguon_khach_hang']}}</th>

                            </tr>

                            <tr>
                                <th class="col-1">Mối quan hệ</th>
                                <th style="vertical-align:middle;text-align:left;font-weight:bold" class="">{{ $khachHang['moi_quan_he'] }}</th>
                            </tr>
                           
                        </tr>
                    </table>
                </div>
                
            </x-simple-card>
        </div>

        <div class="col-6">
            <x-simple-card extClass="mt-3" headerClass="bg-secondary text-white "> 
                <x-slot name="title"><h6 class="text-white">Thông tin người liên hệ</h6></x-slot>
                <div class="table-responsive">
                    <table class="table table-responsive" id="table-chi-tieu">
                        <thead class="table-dark">
                            <tr>
                                <th class="col-1" style="text-align:right">Họ và tên</th>   
                                <th class="col-1">Email</th>
                                <th class="col-4">Điện thoại</th>
                                <th class="col-3" style="text-align:right">Chức vụ</th>                                  
                                <th class="col-3" style="text-align:right">Mô tả</th>                                  
                            </tr>
                        </thead>
                        @foreach ($khachHang['nguoi_lien_he'] as $lienHe)
                            <tr>
                                <th style="vertical-align:middle;border:none" class="">{{ $lienHe->ho_va_ten }}</th>
                                <th style="vertical-align:middle;border:none" class="">{{ $lienHe->email }}</th>
                                <th style="vertical-align:middle;border:none" class="">{{ $lienHe->dien_thoai }}</th>
                                <th style="vertical-align:middle;border:none" class="">{{ ($lienHe->chuc_vu != null)? $lienHe->chuc_vu:'(Chưa cập nhật)' }}</th>
                                <th style="vertical-align:middle;border:none" class="">{{ ($lienHe->mo_ta != null)? $lienHe->mo_ta:'(Chưa cập nhật)' }}</th>
                            </tr>
                        @endforeach
                    </table>
                </div>
                
            </x-simple-card>
        </div>

    </div>



</x-dashboard-layout>
