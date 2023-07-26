<?php 
$current = "Thêm hạng mục thưởng";
$list = [    
    url('/hang-muc')=>'Danh sách hạng mục'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="them_hang_muc" method="POST" id="frm_them_hang_muc" action="{{route('hang-muc.store')}}">
                        @csrf
                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Thêm hạng mục</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">Thông tin hạng mục</p>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ten_hang_muc" class="form-control-label">Tên hạng mục</label>
                                            <input class="form-control" type="text" value="{{old('ten_hang_muc','')}}" name="ten_hang_muc" id="ten_hang_muc"  onfocus="focused(this)" onfocusout="defocused(this)">
                                            @error('ten_hang_muc')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                       
                                    </div> 
                                                               
                                </div>  
                                <div class="col-12">
                                    <label class="label" for="">
                                        Áp dụng cho nhóm
                                    </label>
                                    <select class="form-control" name="id_nhom_nhan_vien" id="id_nhom_nhan_vien">
                                        @foreach($dsNhomNhanVien as $nhomNhanVien)
                                            <option value="{{$nhomNhanVien->id}}">{{$nhomNhanVien->ten_nhom}}</option>
                                        @endforeach

                                    
                                    </select>
                                    @error('group')
                                        <span class="help text-red-500"> {{ $message}}</span>
                                    @enderror
                                </div>   
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="mo_ta" class="form-control-label">Mô tả</label>
                                            <textarea class="form-control" style="height:100px" type="text" name="mo_ta" id="mo_ta">{{old('mo_ta','')}} </textarea>
                                            @error('mo_ta')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                       
                                    </div> 
                                                               
                                </div>                                          
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>

   
</x-dashboard-layout>