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

                        <div class="row">
                            <form action="{{ route('san-pham-thuoc-mo-moi.update', $sanPham) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-4">
                                    <label class="label" for="name">
                                        Loại sản phẩm
                                    </label>
                                    <input class="form-control" id="" name="loai_san_pham" type="text"
                                        placeholder="Loại sản phẩm" value="{!! old('loai_san_pham', optional($sanPham)->danhMucsanPham->ten_san_pham) !!}" disabled>
                                    @error('loai_san_pham')
                                        <span class="help text-red-500"> {{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- input để lấy id sản phẩm thuộc mở mới --}}
                                <input type="text" value="{{$sanPham->id}}" name="id_SPTMM" hidden>
                                <div class="mb-4">
                                    <label class="label" for="">
                                        Tỉ lệ thưởng
                                    </label>
                                    <input class="form-control" id="" name="ti_le_thuong" type="text"
                                        placeholder="Tỉ lệ thưởng" value="{!! old('loai_san_pham', optional($sanPham)->ti_le_thuong) !!}">
                                    @error('ti_le_thuong')
                                        <span class="help text-red-500"> {{ $message }}</span>
                                    @enderror
                                </div>
                               
                                <div class="mb-4">
                                    <button class="btn btn-primary">Cập nhật</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-dashboard-layout>
