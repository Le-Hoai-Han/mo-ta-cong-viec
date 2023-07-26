<x-simple-card extClass="mt-3" headerClass="bg-dark text-white"> 
    <x-slot name="title"><h6 class="text-white">Thêm loại thưởng kỹ thuật</h6></x-slot>
    <x-slot name="button">
        <button class="btn btn-success mb-2">{{$buttonLabel}}</button>
    </x-slot>
    @csrf
    <div class="row">
        <div class="form-group col-12 col-md-6">
            <label for="ma_loai">Mã loại</label>
            <input type="text" id="ma_loai" name="ma_loai" class="form-control" value="{{old('ma_loai',$loaiThuongKyThuat->ma_loai)}}" />
            @error('ma_loai')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group col-12 col-md-6">
            <label for="ten_loai">Tên loại</label>
            <input type="text" id="ten_loai" name="ten_loai" class="form-control" value="{{old('ten_loai',$loaiThuongKyThuat->ten_loai)}}" />
            @error('ten_loai')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="form-group col-12">
            <label for="mo_ta">Mô tả</label>
            <textarea id="mo_ta" name="mo_ta" class="form-control" style="min-height:150px;">{{old('mo_ta',$loaiThuongKyThuat->mo_ta)}}</textarea>
            @error('mo_ta')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
    </div>
</x-simple-card>