<div class="card col-xs-12">
    <div class="card-header pb-0 p-3">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <h6 class="mb-0">Thông tin chỉ tiêu</h6>
            <a  href="{{route('chi-tieu.edit',$chiTieu)}}" class="btn btn-primary btn-md mb-0">Cập nhật</a>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ten_hang_muc" class="form-control-label">Tên chỉ tiêu</label>
                    <input class="form-control" type="text" value="{{$chiTieu->ten_chi_tieu}}" name="ten_chi_tieu" id="ten_chi_tieu"  onfocus="focused(this)" onfocusout="defocused(this)" readonly>
                </div>                            
            </div>    
            
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="ten_hang_muc" class="form-control-label">Áp dụng cho nhóm</label>
                    <input class="form-control" type="text" value="{{$chiTieu->nhomNhanVien->ten_nhom}}" name="ten_chi_tieu" id="ten_chi_tieu"  onfocus="focused(this)" onfocusout="defocused(this)" readonly>
                </div>                            
            </div>  
        
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="loai_chi_tieu" class="form-control-label">Loại chỉ tiêu</label>
                    <input class="form-control" type="text" value="{{$chiTieu->loai_chi_tieu}}" name="loai_chi_tieu" id="loai_chi_tieu"  onfocus="focused(this)" onfocusout="defocused(this)" readonly>
                </div>                            
            </div> 

            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="muc_tieu_mac_dinh" class="form-control-label">Mục tiêu mặc định</label>
                    <input class="form-control" type="text" value="{{$chiTieu->muc_tieu_mac_dinh}}" name="muc_tieu_mac_dinh" id="muc_tieu_mac_dinh"  onfocus="focused(this)" onfocusout="defocused(this)" readonly>
                </div>                            
            </div>                                                     
        
            <div class="col-12 col-md-6">
                <div class="form-group">
                    <label for="chieu_huong_tot" class="form-control-label">Chiều hướng tốt</label>
                    <div class="form-check">
                      <label for="chieu_huong_tot_radio_1" class="custom-control-label" >Tăng dần</label>
                      <input disabled type="radio" class="form-check-input" id="chieu_huong_tot_radio_1" name="chieu_huong_tot" value="1" {{($chiTieu->chieu_huong_tot==$chiTieu::CHIEU_HUONG_TOT_TANG)?" checked ":""}}>
                    </div>
                    <div class="form-check">  
                        <label for="chieu_huong_tot_radio_0" class="custom-control-label">Giảm dần</label>
                        <input disabled type="radio" id="chieu_huong_tot_radio_0" class="form-check-input" name="chieu_huong_tot" value="0" {{($chiTieu->chieu_huong_tot==$chiTieu::CHIEU_HUONG_TOT_GIAM)?" checked ":""}}>
                    </div>
                </div>                            
            </div>
            
            <div class="col-12">
                <div class="form-group">
                    <label for="mo_ta" class="form-control-label">Mô tả</label>
                    <textarea class="form-control"name="mo_ta" id="mo_ta"  onfocus="focused(this)" onfocusout="defocused(this)" readonly>{{$chiTieu->mo_ta}}</textarea>
                </div>                            
            </div>   
            <div class="col-12">
                <div class="form-group">
                    <label for="mo_ta" class="form-control-label">Mô tả</label>
                    <input type="text" class="form-control" name="thu_tu_sap_xep" value="{{$chiTieu->thu_tu_sap_xep}}" readonly/>
                </div>                            
            </div>  
        </div>   
    </div>                              
</div>