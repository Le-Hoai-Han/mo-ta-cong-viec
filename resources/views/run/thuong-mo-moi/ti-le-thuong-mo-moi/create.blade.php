<x-dashboard-layout>
    <x-slot name="title">Cập nhật tỉ lệ thưởng mở mới</x-slot>

    <div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Sửa tỉ lệ thưởng mở mới</h6>
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
                            <form action="{{ route('ti-le-thuong-mo-moi.store') }}" method="POST">
                                @csrf
                               
                                <div class="mb-4">
                                    <label class="label" for="name">
                                        Loại sản phẩm
                                    </label>
                                    <select class="form-control" id="" name="loai_san_pham">
                                        @foreach($loaiSanPham as $loai)
                                        <option value="{{$loai->id}}">{{$loai->name}}</option>
                                        @endforeach
                                    </select>
                                    {{-- input để lấy id loai san pham --}}
                                    <input type="text" name="mo_ta" value="1" hidden>
                                    @error('loai_san_pham')
                                        <span class="help text-red-500"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label class="label" for="">
                                        Tỉ lệ thưởng
                                    </label>
                                    <input class="form-control" id="" name="ti_le_thuong" type="text"
                                        placeholder="Tỉ lệ thưởng" value="{!! old('loai_san_pham') !!}">
                                    @error('ti_le_thuong')
                                        <span class="help text-red-500"> {{ $message }}</span>
                                    @enderror
                                </div>
                              
                                <div class="mb-4">
                                    <label class="label" for="" style="color: red">
                                        **Cập nhật tất cả loại sản phẩm thuộc lớp con
                                    </label>
                                   <select class="form-control" name="cap_nhat_lop_con" id="" style="width: 100px;">
                                    <option value="1">Có</option>
                                    <option value="0" selected >Không</option>
                                   </select>
                                </div>
                              


                                <div class="mb-4">
                                    <button class="btn btn-primary">Cập nhật</button>
                                    <a href="{{route('ti-le-thuong-mo-moi.index')}}" class="btn btn-dark">Quay lại</a>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-dashboard-layout>
