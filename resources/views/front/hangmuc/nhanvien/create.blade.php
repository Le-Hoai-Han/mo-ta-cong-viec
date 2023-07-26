<?php 
$current = "Thêm nhân viên thuộc hạng mục";
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
            @include('front.hangmuc._info',[
                'hangMuc'=>$hangMuc
            ])
        </div>

        <div class="row mt-4" >           
            <form action="{{route('hang-muc.nhan-vien.store',['hangMuc'=>$hangMuc])}}" method="POST" name="them_nhan_vien_hang_muc" id="them_nhan_vien_hang_muc">  
            @csrf
                <div class="card col-12 col-md-8  mb-lg-0 mb-4">                    
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Thêm nhân viên thuộc hạng mục</h6>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>                        
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                                
                             
                            </div>                                    
                        </div>
                    </div>
                </div>
            </form> 

           
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.css">
        <link rel="stylesheet" href="{{asset('css/selectize-bootstrap-5.css')}}">
      
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $("#nhan_vien").selectize();
                $("#thang_su_dung").selectize()
            });
        
        </script> 
    @endpush
</x-dashboard-layout>