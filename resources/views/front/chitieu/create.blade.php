<?php 
$current = "Thêm chỉ tiêu";
$list = [
    route('chi-tieu.index')=>'Danh mục chỉ tiêu'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="them_chi_tieu" method="POST" id="frm_them_chi_tieu" action="{{route('chi-tieu.store')}}">
                        @csrf

                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Thêm chỉ tiêu</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">Thông tin chỉ tiêu</p>
                                
                                <div class="row">
                                    
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="ten_chi_tieu" class="form-control-label">Tên chỉ tiêu</label>
                                            <input class="form-control" type="text" value="{{old('ten_chi_tieu','')}}" name="ten_chi_tieu" id="ten_chi_tieu"  onfocus="focused(this)" onfocusout="defocused(this)">
                                            @error('ten_chi_tieu')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                        
                                    </div> 

                                    <div class="col-12 col-md-6">
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


                                    <div class="col-12 col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="loai_chi_tieu" class="form-control-label">Loại chỉ tiêu</label>
                                            <input class="form-control" type="text" value="{{old('loai_chi_tieu','')}}" name="loai_chi_tieu" id="loai_chi_tieu"  onfocus="focused(this)" onfocusout="defocused(this)">
                                            @error('loai_chi_tieu')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-12 col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="muc_tieu_mac_dinh" class="form-control-label">Mục tiêu mặc định</label>
                                            <input class="form-control" type="text" value="{{old('muc_tieu_mac_dinh','')}}" name="muc_tieu_mac_dinh" id="muc_tieu_mac_dinh"  onfocus="focused(this)" onfocusout="defocused(this)">
                                            @error('muc_tieu_mac_dinh')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                    </div>  
                                    <div class="col-12 col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="chieu_huong_tot" class="form-control-label">Tốt theo chiều hướng</label>
                                            <div class="form-check">
                                                <label for="chieu_huong_tot_radio_1" class="custom-control-label">Tăng</label>
                                                <input type="radio" class="form-check-input" id="chieu_huong_tot_radio_1" name="chieu_huong_tot" value="1" checked>
                                            </div>
                                            <div class="form-check">  
                                                <label for="chieu_huong_tot_radio_0" class="custom-control-label">Giảm</label>
                                                <input type="radio" id="chieu_huong_tot_radio_0" class="form-check-input" name="chieu_huong_tot" value="0" >
                                            </div>
                                            @error('chieu_huong_tot')
                                                <span class="help text-danger"> {{ $message}}</span>
                                            @enderror
                                        </div>
                                    </div> 
                                    <div class="col-12">
                                        <label for="mo_ta" class="form-control-label">Mô tả</label>
                                        <textarea name="mo_ta"  class="form-control" rows="5"></textarea>
                                    </div>   
                                    <div class="col-12">
                                            <label for="thu_tu_sap_xep" class="custom-control-label">Thứ tự sắp xếp</label>
                                                <input type="text" id="thu_tu_sap_xep" class="form-control" name="thu_tu_sap_xep" value="{{$chiTieu->thu_tu_sap_xep}}" />
                                        </div>                                   
                                </div>

<?php /*
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
                                    */?>                                  
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
        <link rel="stylesheet" href="{{asset('css/slimselect.min.css')}}">
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
       
       <script src="{{asset('js/slimselect.min.js')}}"></script>
       <script type="text/javascript">
            new SlimSelect({
                select: '#nhan_vien'
            })
            new SlimSelect({
                select: '#thang_su_dung'
            })
           
        </script>
    @endpush
</x-dashboard-layout>