<?php 
$current = "Thêm thông tin thưởng nhân viên";
$list = [    
    url('/thuong-nhan-vien')=>'Danh sách tiền thưởng nhân viên'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="them_thuong_nhan_vien" method="POST" id="frm_them_thuong_nhan_vien" action="{{route('thuong-nhan-vien.store')}}">
                        @csrf
                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Thêm thông tin thưởng nhân viên</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="thang_su_dung" class="form-control-label">Hạng mục tính thưởng</label>
                                        <select name="hang_muc_thuong" id="hang_muc_thuong" aria-label="Hạng mục" placeholder="Chọn hạng mục tính thưởng"  class="form-control multiple-optgroups">
                                            @foreach ($dsHangMuc as $hangMuc)
                                                <option value="{{$hangMuc->id}}"> {{$hangMuc->ten_hang_muc}}</option>
                                            @endforeach
                                        </select>
                                        @error('hang_muc_thuong')
                                            <span class="help text-danger"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Chọn công thức tính</label>
                                        <select name="cong_thuc_tinh" id="cong_thuc_tinh" aria-label="Công thức tính sử dụng" placeholder="Chọn công thức tính" class="form-control">
                                            @foreach ($dsCongThucTinh as $congThucTinh)
                                                <option value="{{$congThucTinh->id}}"> {{$congThucTinh->ten_cong_thuc . " [ ". $congThucTinh->noi_dung ." ]"}}</option>
                                            @endforeach
                                        </select>
                                        @error('cong_thuc_tinh')
                                            <span class="help text-danger"> {{ $message}}</span>
                                        @enderror
                                    </div>
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
                    </form>
                </div>
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
                $("#hang_muc_thuong").selectize();
                $("#cong_thuc_tinh").selectize();
                $("#nhan_vien").selectize();
                $("#thang_su_dung").selectize()
            });
        
        </script> 
    @endpush
</x-dashboard-layout>