<?php 
$current = "Cập nhật loại sản phẩm";
$list = [
    route('loai-san-pham.index')=>'Danh mục loại sản phẩm'
]
?>
<x-dashboard-layout :list="$list" :current="$current">
    <div class="col-8">
        <x-simple-card extClass="mt-3 " headerClass="bg-info text-white">
            <x-slot name="title">
                <h6 class="text-white">Cập nhật loại sản phẩm</h6>
            </x-slot>
            <x-slot name="button">
                    
            </x-slot>
            <form 
                action="{{route('loai-san-pham.update',$loaiSanPham)}}" 
                method="POST"
            >
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="category_code" class="form-control-label">Mã loại</label>  
                            <input type="text" value="{{$loaiSanPham->code}}" name="code" class="form-control" id="category_code" />
                        </div>
                    </div>    
                    
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="category_name" class="form-control-label">Tên loại</label>  
                            <input type="text" value="{{$loaiSanPham->name}}" name="name" class="form-control" id="category_name" />
                        </div>
                    </div> 

                    <div class="col-12">
                        <div class="form-group">
                            <label for="ti_le_thuong_thanh_ly" class="form-control-label">Tỉ lệ thưởng thanh lý máy</label>  
                            <input type="text" value="{{old('ti_le_thuong_thanh_ly','')}}" name="ti_le_thuong_thanh_ly" class="form-control" id="ti_le_thuong_thanh_ly" />
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-group">
                            <label for="ti_le_thuong_bd" class="form-control-label">Tỉ lệ thưởng team BD (PM)</label>  
                            <input type="text" value="{{old('ti_le_thuong_bd','')}}" name="ti_le_thuong_bd" class="form-control" id="ti_le_thuong_bd" />
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ti_le_thuong_sale" class="form-control-label">Tỉ lệ thưởng team Sale (Nguồn tự tìm)</label>  
                            <input type="text" value="{{old('ti_le_thuong_sale','')}}" name="ti_le_thuong_sale" class="form-control" id="ti_le_thuong_sale" />
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="ti_le_thuong_sale_nguon_co_san" class="form-control-label">Tỉ lệ thưởng team Sale (Nguồn Marketing)</label>  
                            <input type="text" value="{{old('ti_le_thuong_sale_nguon_co_san','')}}" name="ti_le_thuong_sale_nguon_co_san" class="form-control" id="ti_le_thuong_sale_nguon_co_san" />
                        </div>
                    </div>    

                    

                    <div class="col-12">
                        <div class="form-group">
                            <label for="tien_thuong_dich_vu" class="form-control-label">Tiền thưởng đơn dịch vụ</label>  
                            <input type="text" value="{{old('tien_thuong_dich_vu','')}}" name="tien_thuong_dich_vu" class="form-control" id="tien_thuong_dich_vu" />
                        </div>
                    </div>
                </div>
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-md">Cập nhật</button>
                    <a class="btn btn-secondary btn-md" href="{{route('loai-san-pham.index')}}">Hủy</a>
                </div>

            </form>
        </x-simple-card>
    </div>
</x-dashboard-layout>