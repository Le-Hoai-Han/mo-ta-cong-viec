<?php 
$current = "Thêm thông tin thanh toán";
$list = [
    route('don-hang.index')=>'Danh sách đơn hàng',
    route('don-hang.show',['don_hang'=>$donHang])=>$donHang->ma_don_hang
]
?>
<x-dashboard-layout :list="$list" :current="$current">
    <div class="col-12 col-md-6">
        <x-simple-card extClass="mt-3 " headerClass="bg-info text-white">
            <x-slot name="title">
                <h6 class="text-white">Thêm thông tin thanh toán</h6>
            </x-slot>
            <x-slot name="button">
                    
            </x-slot>
            <form 
                action="
                {{route('don-hang.thanh-toan.store',[
                    'don_hang'=>$donHang,
                ])}}
                " 
                method="POST"
            >
                @csrf
                <div class="col-12">
                    <div class="form-group">
                        <label for="so_tien_thanh_toan" class="form-control-label">Số tiền thanh toán</label>                        
                        <input class="form-control" type="text" value="{{old('so_tien_thanh_toan','')}}" name="so_tien_thanh_toan" id="so_tien_thanh_toan"  onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('so_tien_thanh_toan')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                    </div>
                </div>    
                
                <div class="col-12">
                    <div class="form-group">
                        <label for="ngay_thanh_toan" class="form-control-label">Ngày thanh toán</label>                        
                        <input class="form-control" type="text" value="{{old('ngay_thanh_toan',date('d/m/Y'))}}" name="ngay_thanh_toan" id="ngay_thanh_toan"  onfocus="focused(this)" onfocusout="defocused(this)">
                        @error('ngay_thanh_toan')
                            <span class="help text-danger"> {{ $message}}</span>
                        @enderror
                    </div>
                </div>    
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-md">Cập nhật</button>
                    <a class="btn btn-secondary btn-md" href="{{route('don-hang.show',['don_hang'=>$donHang])}}">Hủy</a>
                </div>
            </form>
        </x-simple-card>
    </div>
</x-dashboard-layout>