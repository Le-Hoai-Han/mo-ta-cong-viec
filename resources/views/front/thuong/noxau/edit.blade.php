<?php 
$current = "Thêm thông tin nợ xấu";
$list = [    
    url('/no-xau')=>'Danh sách nợ xấu'
    ];
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div col-xs-12 col-md-6">
        <form action="{{route('no-xau.update',$noXau)}}" method="POST">
            <x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-info text-white "> 
                <x-slot name="title"><h6 class="text-white">
                    Thông tin nợ xấu
                </h6></x-slot>
                <x-slot name="button">
                    <button class="btn btn-md btn-warning" type="button" id="btn_tinh_no">
                        <span class="fa fa-refresh"></span>
                        Tính lại
                    </button>
                    <button class="btn btn-md btn-primary">
                        <span class="fa fa-save"></span>
                        Lưu
                    </button>
                </x-slot>
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ma_don_hang">Mã đơn hàng</label>
                            
                            <input type="text" name="ma_don_hang" id="ma_don_hang" class="form-control"  readonly value="{{$noXau->donHang->ma_don_hang}}" />
                            @error('ma_don_hang')
                                <span class="help text-danger"> {{ $message}}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ngay_bat_dau">Ngày bắt đầu</label>
                            <input type="text" name="ngay_bat_dau" id="ngay_bat_dau" class="form-control" placeholder="Nhập dạng dd-mm-YYYY" value="{{formatNgayDMY(old('ngay_bat_dau',$noXau->ngay_bat_dau))}}"/>
                            @error('ngay_bat_dau')
                                <span class="help text-danger"> {{ $message}}</span>
                            @enderror
                        </div>
                    </div>
                
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tong_so_tien">Tổng số tiền</label>
                            <input type="text" name="tong_so_tien" id="tong_so_tien" class="form-control" value="{{thuGonSoLe(old('tong_so_tien',$noXau->tong_so_tien))}}" />
                            @error('tong_so_tien')
                                <span class="help text-danger"> {{ $message}}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tien_da_tru">Số tiền đã trừ</label>
                            <input type="text" name="tien_da_tru" id="tien_da_tru" class="form-control" value="{{thuGonSoLe(old('tien_da_tru',$noXau->tien_da_tru))}}" />
                            @error('tien_da_tru')
                                <span class="help text-danger"> {{ $message}}</span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
            </x-simple-card>
        </form>
    </div>
    @push('scripts')
    <script async>
        $("#btn_tinh_no").click(function(e){
            e.preventDefault;
            $.ajax({
                url:"{{route('no-xau.tinh-tien-no-dh',$noXau)}}",
                method:'post',
                dataType:'json',
                data:{
                    _token:"{{csrf_token()}}"

                },
                success:function(data) {
                    $("#ngay_bat_dau").val(data.ngay_bat_dau);
                    $("#tong_so_tien").val(data.tong_so_tien);
                    $("#tien_da_tru").val(data.tien_da_tru);
                }

            })
        });
        </script>
    @endpush
</x-dashboard-layout>