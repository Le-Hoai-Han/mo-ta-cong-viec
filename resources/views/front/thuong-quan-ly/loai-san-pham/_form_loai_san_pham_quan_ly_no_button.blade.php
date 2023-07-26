<x-simple-card extClass="mt-3" headerClass="bg-dark text-white"> 
    <x-slot name="title"><h6 class="text-white">Thêm loại sản phẩm có nhóm quản lý</h6></x-slot>
    <x-slot name="button">
        <x-link-quay-ve label="Quay về" :route="url()->previous()"/>
        <button class="btn btn-success mb-2">{{$buttonLabel}}</button>
    </x-slot>
    @csrf
    <div class="row">        
        <div class="form-group col-12 col-md-6">
            <label for="id_nhom_nhan_vien">Nhóm nhân viên</label>
            <select name="id_nhom_nhan_vien" id="id_nhom_nhan_vien" >
                @foreach($dsNhomNhanVien as $nhomNhanVien)
                    <?php 
                    
                    if($nhomNhanVien->id == $loaiSanPhamQuanLy->id_nhom_nhan_vien) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    
                    ?>
                    <option value="{{$nhomNhanVien->id}}" {{$selected}}>{{$nhomNhanVien->ten_nhom}}</option>
                @endforeach 
            </select>
            @error('id_nhom_nhan_vien')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>     
        <div class="form-group col-12 col-md-6">
            <label for="id_loai_san_pham">Loại sản phẩm</label>
            <select name="id_loai_san_pham" id="id_loai_san_pham">
                @foreach($dsLoaiSanPham as $loaiSanPham)
                <?php 
                    
                    if($loaiSanPham->id == $loaiSanPhamQuanLy->id_loai_san_pham) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    
                    ?>
                    <option value="{{$loaiSanPham->id}}" {{$selected}}>{{$loaiSanPham->name}}</option>
                @endforeach 
            </select>
            @error('id_loai_san_pham')
                <span class="text-danger">{{$message}}</span>
            @enderror
        </div>     
    </div>
</x-simple-card>

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.css">
<link rel="stylesheet" href="{{asset('css/selectize-bootstrap-5.css')}}">

@endpush

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
    <script type="text/javascript">
        $("#id_nhom_nhan_vien").selectize();
        $("#id_loai_san_pham").selectize();
    </script>
@endpush 