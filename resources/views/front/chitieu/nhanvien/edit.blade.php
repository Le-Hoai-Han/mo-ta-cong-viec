<?php 
$current = "Cập nhật nhân viên thuộc hạng mục";
$list = [    
    url('/hang-muc')=>'Danh sách hạng mục',
    route('hang-muc.show',[
        'hang_muc'=>$chiTieu
    ])=>$chiTieu->ten_hang_muc
        
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >           
            @include('front.chitieu._info',[
                'hangMuc'=>$chiTieu
            ])
        </div>

        <div class="row mt-4" >           
            <form action="{{route('chi-tieu.nhan-vien.update',['chiTieu'=>$chiTieu,'nhan_vien'=>$nhanVien])}}" method="POST" name="cap_nhat_nhan_vien_hang_muc" id="cap_nhat_nhan_vien_hang_muc">  
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
                                    <input class="form-control" type="text" value="{{$nhanVien->nhanVien->ho_ten}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="thang_su_dung" class="form-control-label">Thời gian áp dụng</label>
                                    <input class="form-control" type="text" value="{{"Tháng ".$nhanVien->thangNam->thang." năm ".$nhanVien->thangNam->nam}}" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                               
                                <div class="form-group">
                                    <label for="muc_tieu" class="form-control-label">Mục tiêu</label>
                                    <input class="form-control" name="muc_tieu" id="muc_tieu" type="text" value="{{ old('muc_tieu',(double)$nhanVien->muc_tieu)}}" placeholder="Mức thưởng tháng">
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="ket_qua_dat_duoc" class="form-control-label">Kết quả đạt được</label>
                                    <input class="form-control" name="ket_qua_dat_duoc" id="ket_qua_dat_duoc" type="text" value=" {{old('ket_qua_dat_duoc',(double)$nhanVien->ket_qua_dat_duoc)}}" placeholder="Số tiền thưởng nhận được">
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