<?php 
$current = "Cập nhật công thức";
$list = [    
    url('/cong-thuc')=>'Danh sách công thức'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="sua_bien_so" method="POST" id="frm_sua_bien_so" action="{{route('bien-so.update',$bienSo)}}">
                        @csrf
                        @method('PUT')
                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <h6 class="mb-0">Cập nhật công thức tính {{$bienSo->ten_bien}}</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <button type="submit" class="btn btn-primary btn-md mb-0">Cập nhật</button>
                                
                                </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <p class="text-uppercase text-sm">Thông tin công thức</p>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="ten_bien_so" class="form-control-label">Tên biến số</label>
                                            <input class="form-control" type="text" value="{{old('ten_bien',$bienSo->ten_bien)}}" name="ten_bien" id="ten_bien"  onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>
                                       
                                    </div> 
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="kieu_du_lieu" class="form-control-label">Kiểu dữ liệu</label>
                                            <input class="form-control" type="text" value="{{old('kieu_du_lieu',$bienSo->kieu_du_lieu)}}" name="kieu_du_lieu" id="kieu_du_lieu"  onfocus="focused(this)" onfocusout="defocused(this)">
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="gia_tri" class="form-control-label">Gía trị</label>
                                            <input class="form-control" name="gia_tri" id="gia_tri" value="{{old('gia_tri',$bienSo->gia_tri)}}" />
                                        </div>                                       
                                    </div> 
                                </div>
                                <div class="row">
                                <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label for="mo_ta" class="form-control-label">Mô tả</label>
                                            <input class="form-control" type="text" value="{{old('mo_ta',$bienSo->mo_ta)}}" name="mo_ta" id="mo_ta"  onfocus="focused(this)" onfocusout="defocused(this)">
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

    <!-- @push('scripts')
        <script src="{{asset('js/slimselect.min.js')}}"></script>
        <script type="text/javascript">
            // new SlimSelect({
            //     select: '#nhan_vien'
            // })
            // new SlimSelect({
            //     select: '#thang_su_dung'
            // })
           
        </script>
    @endpush -->
</x-dashboard-layout>