<?php 
$current = "Cập nhật";
$list = [    
    url('/thuong-nhan-vien')=>'Danh sách tiền thưởng nhân viên',
    route('thuong-nhan-vien.show',[
        'thuong_nhan_vien'=>$thuongNhanVien
    ])=>$thuongNhanVien->nhanVien->ho_ten." tháng ".$thuongNhanVien->thangNam->thang."/".$thuongNhanVien->thangNam->nam
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="them_thuong_nhan_vien" method="POST" id="frm_cap_nhat_thuong_nhan_vien" action="{{route('thuong-nhan-vien.update',['thuong_nhan_vien'=>$thuongNhanVien])}}">
                        @csrf
                        @method('PUT')
                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Cập nhật thông tin thưởng nhân viên</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn btn-primary btn-md mb-0">Lưu cập nhật</button>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12">                                    
                                    @if(Session::has('error'))
                                        <div class="alert alert-danger text-white">{{Session::get('error')}}</div>
                                    @endif   
                                    <div class="form-group">
                                        <label for="thang_su_dung" class="form-control-label">Thời gian áp dụng</label>
                                        <select name="thang_su_dung" id="thang_su_dung" aria-label="Tháng" placeholder="Thời gian áp dụng" class="form-control multiple-optgroups">
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
                                                @if(old('thang_su_dung',$thuongNhanVien->id_thang_nam) == $thang->id) 
                                                    <option value="{{$thang->id}}" selected>Tháng {{$thang->thang}}/{{$nam}}</option>
                                                @else
                                                    <option value="{{$thang->id}}">Tháng {{$thang->thang}}/{{$nam}}</option>
                                                @endif
                                                
                                            @endforeach
                                            </optgroup>
                                            ?>
                                        </select>
                                        @error('thang_su_dung')
                                            <span class="help text-danger"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="nhan_vien" class="form-control-label">Chọn nhân viên</label>
                                        <select name="nhan_vien" id="nhan_vien" aria-label="Người nhận chỉ tiêu" placeholder="Người nhận chỉ tiêu" class="form-control">
                                            @foreach ($dsNhanVien as $nhanVien)
                                                @if(old('nhan_vien',$thuongNhanVien->id_nhan_vien) == $nhanVien->id) 
                                                    <option value="{{$nhanVien->id}}" selected> {{$nhanVien->ho_ten}}</option>
                                                @else
                                                    <option value="{{$nhanVien->id}}"> {{$nhanVien->ho_ten}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('nhan_vien')
                                            <span class="help text-danger"> {{ $message}}</span>
                                        @enderror
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="ngan_sach_thuong">Ngân sách thưởng</label>
                                        <input type="text" class="form-control" name="ngan_sach_thuong" value="{{old('ngan_sach_thuong',$thuongNhanVien->ngan_sach_thuong)}}" id="ngan_sach_thuong" />
                                        @error('ngan_sach_thuong')
                                            <span class="help text-danger"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="tong_tien_thuong_dat_duoc">Tổng tiền thưởng đạt được</label>
                                        <input type="text" class="form-control" name="tong_tien_thuong_dat_duoc" value="{{old('tong_tien_thuong_dat_duoc',$thuongNhanVien->tong_tien_thuong_dat_duoc)}}" id="tong_tien_thuong_dat_duoc" />
                                        @error('tong_tien_thuong_dat_duoc')
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
               
                $("#nhan_vien").selectize();
                $("#thang_su_dung").selectize()
            });
        
        </script> 
    @endpush
</x-dashboard-layout>