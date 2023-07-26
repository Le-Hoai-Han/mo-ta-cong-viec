<?php 
$current = "Cập nhật";
$list = [    
    url('/hang-muc')=>'Danh sách hạng mục',
    route('hang-muc.show',[
        'hang_muc'=>$hangMuc
    ])=>$hangMuc->ten_hang_muc
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="cap_nhat_hang_muc" method="POST" id="frm_cap_nhat_hang_muc" action="{{route('hang-muc.update',['hang_muc'=>$hangMuc])}}">
                        @csrf
                        @method('PUT')
                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Cập nhật hạng mục</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-primary btn-md mb-0">Cập nhật</button>
                                
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">Thông tin hạng mục</p>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="ten_hang_muc" class="form-control-label">Tên hạng mục</label>
                                            <input class="form-control" type="text" value="{{old('ten_hang_muc',$hangMuc->ten_hang_muc)}}" name="ten_hang_muc" id="ten_hang_muc"  onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>
                                       
                                    </div> 
                                                               
                                </div>     
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="mo_ta" class="form-control-label">Mô tả</label>
                                            <textarea class="form-control" type="text" name="mo_ta" id="mo_ta">{{old('mo_ta',$hangMuc->mo_ta)}} </textarea>
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