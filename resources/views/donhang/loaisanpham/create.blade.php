<?php 
$current = "Thêm loại sản phẩm";
$list = [
    
]
?>
<x-dashboard-layout :list="$list" :current="$current">
    <div class="col-12">
        <x-simple-card extClass="mt-3 " headerClass="bg-info text-white">
            <x-slot name="title">
                <h6 class="text-white">Thêm loại sản phẩm</h6>
            </x-slot>
            <x-slot name="button">
                    
            </x-slot>
            <form 
                action="{{route('loai-san-pham.store')}}" 
                method="POST"
            >
                @csrf
                <div class="col-12">
                    <div class="form-group">
                        <label for="du_lieu_json" class="form-control-label">Dữ liệu GetFly</label>                        

                        <textarea class="form-control" name="du_lieu_json" rows="20" id="du_lieu_json"></textarea>
                    </div>
                </div>    
                
            
                
                <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-md">Lưu</button>
                    <a class="btn btn-secondary btn-md" href="{{route('loai-san-pham.index')}}">Hủy</a>
                </div>
            </form>
        </x-simple-card>
    </div>
</x-dashboard-layout>