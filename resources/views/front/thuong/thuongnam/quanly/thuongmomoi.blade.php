    <div class="col-xl-4 col-md-3">
        <div class="card">
            <div class="card-header pb-0 p-3 bg-primary">
                <div class="row">
                    <div class="col-12 d-flex align-items-center">
                        <h6 class="text-white mb-3">Thưởng mở mới</h6>
                    </div>
                </div>
            </div> 
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="tong_tien_thuong_mo_moi_ca_nhan" class="form-control-label">Tổng tiền thưởng mở mới <sup style="color:red"> {{($quanLy ? '(4)' :'')}} </sup></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($tienThuongMoMoiDaNhan)}}" aria-label="Tổng tiền thưởng đã nhận trong kì" aria-describedby="tong_tien_thuong_mo_moi_ca_nhan" readonly id="tong_tien_thuong_mo_moi_ca_nhan">
                                
                            </div>                                    
                        </div> 
                    </div>
                    @if($quanLy)
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="tong_tien_thuong_mo_moi_ca_team" class="form-control-label">Tổng tiền thưởng mở mới của team <sup style="color:red"> {{($quanLy ? '(5)' :'')}} </sup></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($tienThuongMoMoiCuaCaTeam)}}" aria-label="Tổng tiền thưởng mở mới của cả team" aria-describedby="tong_tien_thuong_mo_moi_ca_team" readonly id="tong_tien_thuong_mo_moi_ca_team">
                                
                            </div>                                    
                        </div>  
                    </div>
                    @endif
                </div>
            </div>
            <div class="card-footer bg-secondary">
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="tong_tien_thuong_mo_moi_da_nhan" class="form-control-label text-white">Tổng tiền thưởng mở mới đã nhận <sup style="color: darkred"> {{$quanLy ?'( (4) + (5) x 30% )':''}}  </sup></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{thuGonSoLe($tienThuongMoMoiDaNhan + $tienThuongMoMoiCuaCaTeam *0.3)}}" aria-label="Tổng tiền thưởng mở mới của cả team" aria-describedby="tong_tien_thuong_mo_moi_da_nhan" readonly id="tong_tien_thuong_mo_moi_da_nhan">
                            
                        </div>                                    
                    </div>  
                </div> 
            </div>
        </div>
    </div>