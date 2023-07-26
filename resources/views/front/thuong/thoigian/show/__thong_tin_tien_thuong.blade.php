<?php $quanLy = $thuongKhoangThoiGian->nhanVien->laQuanLy()?>
{{-- <div class="row">
    <div class="alert" style="display:none" id="noti_tinh_tien_thuong"></div>
    <div class="col-12 col-md-{{$quanLy ? '4' :'6'}}">
        <div class="form-group">
            <label for="ngan_sach_thuong" class="form-control-label">Ngân sách thưởng đạt được {{($quanLy ? '(1)' :'')}} </label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_ngan_sach_thuong - $tongNganSachThuongCaTeam *40/100)}}" aria-label="Ngân sách thưởng" aria-describedby="ngan_sach_thuong_value" readonly id="ngan_sach_thuong_value">
                
            </div>                                    
        </div>                              
    </div>   
    <div class="col-12 col-md-4" style="{{$quanLy ? '' :'display:none'}}">
        <div class="form-group">
            <label for="ngan_sach_thuong_cua_team" class="form-control-label">Ngân sách thưởng cả team đạt được {{($quanLy ? '(2)' :'')}}</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($tongNganSachThuongCaTeam)}}" aria-label="Ngân sách thưởng" aria-describedby="ngan_sach_thuong_cua_team" readonly id="ngan_sach_thuong_cua_team">
                
            </div>                                    
        </div>                              
    </div> 
    <div class="col-12 col-md-4" style="{{$quanLy ? '' :'display:none'}}">
        <div class="form-group">
            <label for="ngan_sach_thuong_da_nhan" class="form-control-label">Tổng ngân sách thưởng ( (1) + (2) x 40% )</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_ngan_sach_thuong)}}" aria-label="Ngân sách thưởng" aria-describedby="ngan_sach_thuong_da_nhan" readonly id="ngan_sach_thuong_da_nhan">
                
            </div>                                    
        </div>                              
    </div> 
    
    
    <div class="col-12 col-md-{{$quanLy ? '4' :'6'}}">
        <div class="form-group">
            <label for="tong_tien_thuong_mo_moi_ca_nhan" class="form-control-label">Tổng tiền thưởng mở mới {{($quanLy ? '(4)' :'')}}</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($tienThuongMoMoiDaNhan - ($tienThuongMoMoiCuaCaTeam * 0.3))}}" aria-label="Tổng tiền thưởng đã nhận trong kì" aria-describedby="tong_tien_thuong_mo_moi_ca_nhan" readonly id="tong_tien_thuong_mo_moi_ca_nhan">
                
            </div>                                    
        </div> 
    </div>
    <div class="col-12 col-md-4" style="{{$quanLy ? '' :'display:none'}}">
        <div class="form-group">
            <label for="tong_tien_thuong_mo_moi_ca_team" class="form-control-label">Tổng tiền thưởng mở mới của team (5)</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($tienThuongMoMoiCuaCaTeam)}}" aria-label="Tổng tiền thưởng mở mới của cả team" aria-describedby="tong_tien_thuong_mo_moi_ca_team" readonly id="tong_tien_thuong_mo_moi_ca_team">
                
            </div>                                    
        </div>  
    </div>
    <div class="col-12 col-md-4" style="{{$quanLy ? '' :'display:none'}}">
        <div class="form-group">
            <label for="tong_tien_thuong_mo_moi_da_nhan" class="form-control-label">Tổng tiền thưởng mở mới đã nhận ( (4) + (5) x 30% )</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($tienThuongMoMoiDaNhan)}}" aria-label="Tổng tiền thưởng mở mới của cả team" aria-describedby="tong_tien_thuong_mo_moi_da_nhan" readonly id="tong_tien_thuong_mo_moi_da_nhan">
                
            </div>                                    
        </div>  
    </div>
    <div class="col-12 col-md-6">
        <div class="form-group">
            <label for="tong_tien_thuong_dat_duoc" class="form-control-label">Tổng tiền thưởng đạt được</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_tien_thuong_dat_duoc)}}" aria-label="Tổng tiền thưởng đạt được" aria-describedby="tong_tien_thuong_dat_duoc" readonly id="tong_tien_thuong_dat_duoc">
                
            </div>                                    
        </div>                              
    </div>

    <div class="col-12 col-md-6"> 
        <div class="form-group">
            <label for="tong_tien_thuong_da_nhan" class="form-control-label">Tổng tiền thưởng đã nhận trong kì</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_tien_thuong_da_nhan)}}" aria-label="Tổng tiền thưởng đã nhận trong kì" aria-describedby="tong_tien_thuong_da_nhan" readonly id="tong_tien_thuong_da_nhan">
                
            </div>                                    
        </div>                            
    </div>
     
   
    @if($thuongKhoangThoiGian->loai == $thuongKhoangThoiGian::LOAI_THUONG_NAM)
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="tong_tien_no_xau" class="form-control-label">Tổng tiền nợ xấu</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_no_xau_phai_tru)}}" aria-label="Tổng tiền nợ xấu phải trừ" aria-describedby="tong_no_xau_phai_tru" readonly id="tong_no_xau_phai_tru">
                    
                </div>                                    
            </div>                              
        </div>

        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="tien_no_xau_phai_tru" class="form-control-label">5% Tổng tiền nợ xấu</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tien_no_xau_phai_tru)}}" aria-label="Tổng tiền nợ xấu phải trừ" aria-describedby="tien_no_xau_phai_tru" readonly id="tien_no_xau_phai_tru">
                    
                </div>                                    
            </div>                              
        </div>

        <div class="col-12 col-md-4">
            <div class="form-group">
                <label for="tien_no_xau_phai_tru" class="form-control-label">Tổng quỹ rủi ro</label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->getTongQuyRuiRo())}}" aria-label="Tổng quỹ rủi ro" aria-describedby="tổng quỹ rủi ro" readonly id="tong_quy_rui_ro">
                    
                </div>                                    
            </div>                              
        </div>
    </div>
    @endif

    <div class="col-12 col-md-4">
        <div class="form-group">
            <label for="tong_tien_thuong_con_lai" class="form-control-label">Tổng tiền thưởng còn lại</label>
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tien_thuong_con_lai)}}" aria-label="Tổng tiền thưởng đã nhận" aria-describedby="tong_tien_thuong_con_lai" readonly id="tong_tien_thuong_con_lai">
                
            </div>                                    
        </div>                              
    </div>
    <div class="col-12 col-md-2">
    <label for="btn_tinh_lai" class="form-control-label"></label>
        <div class="input-group ">
            <button data-href="{{route('thuong-thoi-gian.tinh-tien-thuong',['thuongKhoangThoiGian'=>$thuongKhoangThoiGian])}}" class="btn btn-warning btn-md mt-1" type="button" id="button_tinh_tien_thuong_thoi_gian">
                <div class="d-flex align-items-center">         
                    <span class='material-icons '>update</span>
                    Tính lại
                </div>
                </button>    
        </div>                                 
    </div>    
                                            
</div> --}}
<div class="row">
    @include('front.thuong.thuongnam.quanly.ngansachthuong')
    @include('front.thuong.thuongnam.quanly.thuongmomoi') 
    @if($thuongKhoangThoiGian->loai == $thuongKhoangThoiGian::LOAI_THUONG_NAM)
    @include('front.thuong.thuongnam.quanly.noxau') 
    @endif 
    @include('front.thuong.thuongnam.quanly.tienthuong') 
</div>  


@push('scripts')
<script defer>    
    const tinhTienButton = document.querySelector('#button_tinh_tien_thuong_thoi_gian');
    tinhTienButton.addEventListener('click',(e)=>{
        // console.log(tinhTienButton.dataset.href);
        $.ajax({
            url: tinhTienButton.dataset.href,
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",    
            },
            dataType:'json',
            success:function(result) {                    
                if(result.status=='success') {
                    console.log(result.data);
                    $("#ngan_sach_thuong_value").val(result.data.tong_ngan_sach_thuong).attr('class','form-control text-success');
                    $("#ngan_sach_thuong_cua_team").val(result.data.tong_ngan_sach_thuong_cua_team).attr('class','form-control text-success');
                    $("#ngan_sach_thuong_da_nhan").val(result.data.tong_ngan_sach_thuong_da_nhan).attr('class','form-control text-success');
                    $("#tong_tien_thuong").val(result.data.tong_tien_thuong).attr('class','form-control text-success');
                    $("#tong_tien_thuong_dat_duoc").val(result.data.tong_tien_thuong_dat_duoc).attr('class','form-control text-success');
                    
                    $("#tong_tien_thuong_con_lai").val(result.data.tong_tien_thuong_con_lai).attr('class','form-control text-success');
                    $("#tien_no_xau_phai_tru").val(result.data.tien_no_xau_phai_tru).attr('class','form-control text-success');
                    $("#tong_no_xau_phai_tru").val(result.data.tong_no_xau_phai_tru).attr('class','form-control text-success');
                    $("#tong_no_xau_cua_team").val(result.data.tong_no_xau_cua_team).attr('class','form-control text-success');
                    $("#tien_no_xau_cua_team").val(result.data.tien_no_xau_cua_team).attr('class','form-control text-success');
                    $("#tong_tien_thuong_mo_moi_ca_nhan").val(result.data.tong_tien_thuong_mo_moi_ca_nhan).attr('class','form-control text-success');
                    $("#tong_tien_thuong_mo_moi_ca_team").val(result.data.tong_tien_thuong_mo_moi_ca_team).attr('class','form-control text-success');
                    $("#tong_tien_thuong_mo_moi_da_nhan").val(result.data.tong_tien_thuong_mo_moi_da_nhan).attr('class','form-control text-success');
                    $("#noti_tinh_tien_thuong").attr('class','alert alert-success');
                } else {
                    $("#noti_tinh_tien_thuong").attr('class','alert alert-danger text-white');
                }
                $("#noti_tinh_tien_thuong").html(result.message).show();
            }
        });
    });
</script>
@endpush