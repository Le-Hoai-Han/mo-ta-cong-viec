<?php 
$current = "Quan hệ";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Quan hệ</x-slot>

    <?php 
    $list = [
        '/'=>'Trang chủ',
        route('nhiem-vu.index')=>'Danh sách nhiệm vụ'
    ]
    ?> 
    <div class="main-div">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Cập nhật quan hệ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('quan-he.update',$quanHe)}}" method="POST">
                        @csrf   
                        @method('PUT')     
                        
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label class="label" for="id_vi_tri">
                                        Vị Trí
                                    </label>
                                    <select name="id_vi_tri" class="form-control">
                                        @foreach($listViTri as $viTri)
                                        <option {{$viTri->id == $quanHe->viTri->id ?'selected':''}} value="{{$viTri->id}}">{{$viTri->ten_vi_tri}}</option>
                                        @endforeach
                                    </select>
                                    @error('id_vi_tri')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="loại">
                                        Loại 
                                    </label>
                                   <select name="loai" class="form-control">
                                        <option {{$quanHe->loai == 1 ?'selected':''}} value="1">Bên trong công ty</option>
                                        <option {{$quanHe->loai == 2 ?'selected':''}} value="2">Bên ngoài công ty</option>
                                   </select>
                                    @error('loai')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="mb-4">
                                    <label class="label" for="noi_dung">
                                        Nội dung 
                                    </label>
                                    <textarea rows="5" class="form-control" 
                                    id="noi_dung" 
                                    name="noi_dung" 
                                    type="text" 
                                    placeholder="Nội dung"                        
                                    value="">{{old('noi_dung',$quanHe->noi_dung)}}</textarea>
                                    @error('noi_dung')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                               
                                
                            </div>
                            <div class="mb-4">
                                <button class="btn btn-primary">Lưu</button>
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </div>
                            
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-dashboard-layout>