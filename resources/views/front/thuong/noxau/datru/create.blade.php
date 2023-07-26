<?php 
$current = "Thêm thông tin thanh toán";
$list = [    
    url('/no-xau')=>'Danh sách nợ xấu',
    route('no-xau.show',[
        'noXau'=>$noXau
    ])=>'Đơn hàng '.$noXau->donHang->ma_don_hang
    

    ];
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div col-xs-12 col-md-6">
        <form action="{{route('no-xau.chi-tiet.store')}}" method="POST">
            <x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-info text-white "> 
                <x-slot name="title"><h6 class="text-white">
                    Thông tin thanh toán khoản nọ xấu
                </h6></x-slot>
                <x-slot name="button">
                    <button class="btn btn-md btn-primary">
                        <span class="fa fa-save"></span>
                        Lưu
                    </button>
                </x-slot>
                @csrf
                <input type="hidden" name="id_no_xau" value="{{$noXau->id}}" />
                <div class="row">
                    <div class="form-group">
                        <label for="ngay_tru">Ngày thanh toán</label>
                        <input type="text" name="ngay_tru_no" id="ngay_tru_no" class="form-control" placeholder="Nhập dạng dd-mm-YYYY" />
                        @error('ngay_tru_no')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="so_tien">Số tiền đã trừ</label>
                        <input type="text" name="so_tien" id="so_tien" class="form-control" placeholder="Nhập số tiền" />
                        @error('so_tien')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                    </div>
                </div>
            </x-simple-card>
        </form>
    </div>
</x-dashboard-layout>