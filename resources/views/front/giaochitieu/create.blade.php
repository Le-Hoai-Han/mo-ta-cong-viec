<?php 
$current = "Giao chỉ tiêu nhân viên";
$list = [
    route('chi-tieu.index')=>'Danh mục chỉ tiêu'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="them_chi_tieu" method="POST" id="frm_them_chi_tieu" action="{{route('giao-chi-tieu.store')}}">
                        @csrf
                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Giao chỉ tiêu</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if(Session::has('error'))
                                    <div class="alert alert-danger">{{Session::get('error')}}</div>
                                @endif
                                @if(Session::has('success'))
                                    <div class="alert alert-success">{{Session::get('success')}}</div>
                                @endif   
                                <p class="text-uppercase text-sm">Thông tin chỉ tiêu</p>
                                
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">Chọn chỉ tiêu</label>
                                            <select for=""  class="form-control" name="ten_chi_tieu"  id="ten_chi_tieu">
                                                @foreach($chiTieu as $CT)
                                                <option id='' value="{{$CT->id}}" >{{$CT->ten_chi_tieu}}</option>
                                                @endforeach
                                            </select>

                                            @error('ten_chi_tieu')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                        
                                    </div> 
                                    <!-- <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="loai_chi_tieu" class="form-control-label">Loại chỉ tiêu</label>
                                            <select class="form-control" name="loai_chi_tieu" id="loai_chi_tieu">
                                           
                                            </select>
                                            @error('loai_chi_tieu')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror

                                        </div>                                    
                                    </div> -->
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Đặt chỉ tiêu cá nhân</p>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="thang_su_dung" class="form-control-label">Thời gian áp dụng</label>
                                            <select name="thang_su_dung[]" id="thang_su_dung" aria-label="Tháng" placeholder="Thời gian áp dụng" multiple="multiple" class="form-control multiple-optgroups">
                                                @php 
                                                    $nam = $dsThang[0]->nam;
                                                @endphp
                                                <optgroup label="Năm {{$nam}}">  
                                                @foreach ($dsThang as $thang):                                       
                                                    @if($nam!=$thang->nam)
                                                        </optgroup>
                                                        <optgroup label="{{$thang->nam}}">  
                                                        @php
                                                            $nam = $thang->nam; 
                                                        @endphp                            
                                                    @endif                                          
                                                        <option value="{{$thang->id}}">Tháng {{$thang->thang}}/{{$nam}}</option>
                                                @endforeach
                                                </optgroup>
                                                ?>
                                            </select>
                                            @error('thang_su_dung')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Chọn nhân viên</label>
                                            <select name="nhan_vien[]" id="nhan_vien" aria-label="Người nhận chỉ tiêu" placeholder="Người nhận chỉ tiêu" multiple="multiple" class="form-control">
                                                @foreach ($dsNhanVien as $nhanVien)
                                                    <option value="{{$nhanVien->id}}"> {{$nhanVien->ho_ten}}</option>
                                                @endforeach
                                            </select>
                                            @error('nhan_vien')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="muc_tieu" class="form-control-label">Số lượng yêu cầu</label>
                                            <input class="form-control" type="text" value="{{old('muc_tieu','')}}" name="muc_tieu" id="muc_tieu" placeholder="Nhập số lượng" onfocus="focused(this)" onfocusout="defocused(this)">
                                            @error('muc_tieu')
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

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.css">
        <link rel="stylesheet" href="{{asset('css/selectize-bootstrap-5.css')}}">

        
        <style>
        .ss-main .ss-multi-selected,
        .ss-main .ss-single-selected{
            min-height:38px;
            padding:0.2rem 0.3rem;
        }
        .ss-main{
            padding:0;
        }
        </style>
      
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
        
        <script type="text/javascript">
        $(function () {
            $("#nhan_vien").selectize();
            $("#thang_su_dung").selectize()

            // function showLoaiChiTieu(){
            //     let ten_chi_tieu=document.getElementById('ten_chi_tieu').value;
            //     document.getElementById('loai_chi_tieu').innerHTML=`<option value="1">`+ten_chi_tieu+`</option>`;
                
            // }
        });       
        </script> 
    @endpush    

</x-dashboard-layout>