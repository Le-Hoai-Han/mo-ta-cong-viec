<?php 
$current = "Nhiệm vụ";

?>

<x-dashboard-layout :current="$current">
    <x-slot name="title">Mô tả nhiệm vụ</x-slot>

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
                        <h5>Cập nhật mô tả nhiệm vụ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('mo-ta-nhiem-vu.update',$moTaNhiemVu)}}" method="POST">
                        @csrf   
                        @method('PUT')     
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-4">
                                    <label class="label" for="ten_nhiem_vu">
                                        Tên nhiệm vụ
                                    </label>
                                    <select name="id_nhiem_vu" class="form-control">
                                        @foreach($listNhiemVu as $nhiemVu)
                                        <option {{$moTaNhiemVu->nhiemVu->id == $nhiemVu->id ?'selected':''}} value="{{$nhiemVu->id}}">{{$nhiemVu->ten_nhiem_vu}}</option>
                                        @endforeach
                                    </select>
                                    @error('ten_nhiem_vu')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-4">
                                    <label class="label" for="chi_tiet">
                                        Chi tiết 
                                    </label>
                                    <textarea rows="5" class="form-control" 
                                    id="" 
                                    name="chi_tiet" 
                                    type="text" 
                                    placeholder="Chi tiết"                        
                                    value="">{{old('chi_tiet',$moTaNhiemVu->chi_tiet)}}</textarea>
                                    @error('chi_tiet')
                                        <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="ket_qua">
                                            Kết quả 
                                        </label>
                                        <textarea rows="5" class="form-control" 
                                        id="ket_qua" 
                                        name="ket_qua" 
                                        type="text" 
                                        placeholder="Kết quả"                        
                                        value="">{{old('ket_qua',$moTaNhiemVu->ket_qua)}}</textarea>
                                        @error('ket_qua')
                                            <span class="help text-red-500" style="color: red"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-4">
                                        <label class="label" for="mo_ta">
                                            Mô tả 
                                        </label>
                                        <textarea rows="5" class="form-control"
                                        name="mo_ta" 
                                        type="text" 
                                        placeholder="Mô tả"                        
                                        value=""
                                    >{{old('mo_ta',$moTaNhiemVu->mo_ta)}}</textarea>
                                        @error('mo_ta')
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