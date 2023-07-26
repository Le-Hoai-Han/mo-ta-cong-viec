<?php 
$current = "Cập nhật thưởng nhân viên theo hạng mục";

$list = [    
    // url('/thuong-nhan-vien')=>'Danh sách thưởng nhân viên',
    // route('thuong-nhan-vien.show',[
    //     'thuong_nhan_vien'=>$thuongNhanVien
    // ])=>$thuongNhanVien->thuongHangMuc->ho_ten." - Tháng ".$thuongNhanVien->thangNam->thang
        
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >           
            {{-- @include('front.hangmuc._info',[
                'hangMuc'=>$hangMuc
            ]) --}}
        </div>

        <div class="row mt-4" >           
            <form action="{{route('thuong-nhan-vien.thuong-hang-muc.update',[
                'thuongNhanVien'=>$thuongNhanVien,
                'thuong_hang_muc'=>$thuongHangMuc])}}" method="POST" name="cap_nhat_nhan_vien_hang_muc" id="cap_nhat_nhan_vien_hang_muc">  
            @csrf
            @method('PUT')
                <div class="card col-12 col-md-12  mb-lg-0 mb-4">                    
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Cập nhật thông tin</h6>
                            </div>
                            <div class="col-6 text-end">
                                <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thay đổi</button>                        
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6">
                               
                                <div class="form-group">
                                    <label for="thang_su_dung" class="form-control-label">Họ tên</label>
                                    <input class="form-control" type="text" value="{{$thuongNhanVien->nhanVien->ho_ten}}" readonly>
                                    
                                </div>
                                
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="thang_su_dung" class="form-control-label">Thời gian áp dụng</label>
                                    <input class="form-control" type="text" value="{{"Tháng ".$thuongNhanVien->thangNam->thang." năm ".$thuongNhanVien->thangNam->nam}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                               
                                <div class="form-group">
                                    <label for="thang_su_dung" class="form-control-label">Hạng mục tính thưởng</label>
                                    <input class="form-control" type="text" value="{{$hangMuc->ten_hang_muc}}" readonly>
                                    
                                </div>
                                
                            </div>
                            <div class="col-12 col-md-6">
                                {{-- <div class="form-group">
                                    <label for="thang_su_dung" class="form-control-label">Công thức tính</label>
                                    <input class="form-control" type="text" value="" readonly>
                                </div> --}}
                            </div>
                            <div class="col-12 col-md-6">
                               
                                <div class="form-group">
                                    <label for="muc_thuong" class="form-control-label">Mức thưởng(%)</label>
                                    <input class="form-control" name="muc_thuong" id="muc_thuong" type="text" value="{{ old('so_tien_thuong',(double)$thuongHangMuc->muc_thuong)}}" placeholder="Mức thưởng tháng">
                                    @error('muc_thuong')
                                        <span class="help text-danger"> {{ $message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="so_tien_thuong" class="form-control-label">Số tiền thưởng nhận được</label>
                                    <input class="form-control" name="so_tien_thuong" id="so_tien_thuong" type="text" value="{{old('so_tien_thuong',(double)$thuongHangMuc->so_tien_thuong)}}" placeholder="Số tiền thưởng nhận được">
                                    @error('so_tien_thuong')
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