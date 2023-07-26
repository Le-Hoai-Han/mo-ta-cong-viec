<?php 
$current = "Nhiệm vụ";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Thêm nhiệm vụ</x-slot>

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
                        <h5>Thêm nhiệm vụ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('nhiem-vu.update',$nhiemVu)}}" method="POST">
                        @csrf
                        @method('PUT')                  
                            <div class="mb-4">
                                <label class="label" for="ten_nhiem_vu">
                                    Tên nhiệm vụ
                                </label>
                                <input class="form-control" 
                                    id="name" 
                                    name="ten_nhiem_vu" 
                                    type="text" 
                                    placeholder="Tên nhiệm vụ"                        
                                    value="{!! old('ten_nhiem_vu', $nhiemVu->ten_nhiem_vu) !!}"
                                >
                                @error('ten_nhiem_vu')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                            

                            <div class="mb-4">
                                <label class="label" for="id_vi_tri">
                                    Vị trí
                                </label>
                                <select  name="id_vi_tri" id="" class="form-control">
                                    @foreach($listViTri as $viTri)
                                    <option {{$nhiemVu->viTri->id == $viTri->id ? 'selected' :''}} value="{{$viTri->id}}">{{$viTri->ten_vi_tri}}</option>
                                    @endforeach
                                </select>
                                @error('id_vi_tri')
                                    <span class="help text-red-500"> {{ $message}}</span>
                                @enderror
                            </div>

                           
                            <div class="mb-4">
                                <button class="btn btn-primary">Lưu</button>
                                <a href="{{url()->previous()}}" class="btn btn-secondary">Hủy</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</x-dashboard-layout>