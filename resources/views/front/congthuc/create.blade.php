<?php 
$current = "Thêm công thức";
?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="them_cong_thuc" method="POST" id="frm_them_cong_thuc" action="{{route('cong-thuc.store')}}">
                        @csrf
                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Thêm công thức tính</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">Thông tin công thức</p>
                                
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="ten_cong_thuc" class="form-control-label">Tên công thức</label>
                                            <input class="form-control" type="text" value="{{old('ten_cong_thuc','')}}" name="ten_cong_thuc" id="ten_cong_thuc"  onfocus="focused(this)" onfocusout="defocused(this)">
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
                                            <label for="mo_ta" class="form-control-label">Mô tả</label>
                                            <input class="form-control" type="text" value="{{old('mo_ta','')}}" name="mo_ta" id="mo_ta"  onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="noi_dung" class="form-control-label">Nội dung công thức</label>
                                            <textarea class="form-control" name="noi_dung" id="noi_dung" rows="3" > {{old('noi_dung','')}}</textarea>
                                        </div>                                       
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        
                                        <div class="form-group">
                                            <label for="loai_chi_tieu" class="form-control-label">Trạng thái</label>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="trang_thai" name="dang_su_dung" value="1" checked="">
                                                <label class="form-check-label" for="trang_thai">Sử dụng</label>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-12">
                                        <label for="loai" class="custom-control-label">Loại</label>
                                        <select name="loai" class="form-select"> 
                                        @foreach($congThucTinh->dsLoaiCongThuc as $id=>$loai)
                                            <option value="{{$id}}">{{$loai}}</option>
                                        @endforeach
                                        </select>
                                    </div> 
                                    <div class="col-12">
                                        <label for="thu_tu_sap_xep" class="custom-control-label">Thứ tự sắp xếp</label>
                                        <input type="text" id="thu_tu_sap_xep" class="form-control" name="thu_tu_sap_xep" value="99" />
                                    </div>                                   
                                </div>  
                                
                                 
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{asset('css/slimselect.min.css')}}">
        <style>
        .ss-main .ss-multi-selected,
        .ss-main .ss-single-selected{
            min-height:38px;
            padding:0.2rem 0.3rem
        }
        .ss-main{
            padding:0;
        }
        </style>
    @endpush

    @push('scripts')
        <script src="{{asset('js/slimselect.min.js')}}"></script>
        <script type="text/javascript">
            // new SlimSelect({
            //     select: '#nhan_vien'
            // })
            // new SlimSelect({
            //     select: '#thang_su_dung'
            // })
           
        </script>
    @endpush
</x-dashboard-layout>