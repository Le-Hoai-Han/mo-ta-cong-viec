<x-dashboard-layout>
    <x-slot name="title">Thêm đơn hàng vào thưởng mở mới</x-slot>

    <div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Thêm đơn hàng vào thưởng mở mới</h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if(Session::has('error'))
                        <div style="color:white;width: fit-content" class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
    
                        @if(Session::has('success'))
                            <div class="alert alert-success" style="width: fit-content">{{Session::get('success')}}</div>
                        @endif 
                        <div class="row">
                            <form action="{{ route('thuong-mo-moi-kh-dh.store') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="label" for="name">
                                        Đơn hàng
                                    </label>
                                    <select class="form-control" id="" name="id_don_hang[]" multiple="multiple" style="height: 250px;">
                                        @foreach($listDonHang as $donHang)
                                                <option value="{{$donHang->id}}">{{$donHang->ma_don_hang}} ( {{$donHang->ngay_tao_don}} ) - ( {{$donHang->nhanVien->ho_ten}} )</option>
                                        @endforeach
                                    </select>
                                    @error('id_don_hang')
                                        <span class="help text-red-500"> {{ $message }}</span>
                                    @enderror
                                </div>
 
                                <div class="mb-4">
                                    <button class="btn btn-primary">Thêm</button>
                                    <a class="btn btn-dark" href="{{route('thuong-mo-moi-kh-dh.index')}}">Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-dashboard-layout>
