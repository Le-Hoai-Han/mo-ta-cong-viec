    <div class="col-xl-4 col-md-3">
        <div class="card">
            <div class="card-header pb-0 p-3 bg-success">
                <div class="row">
                    <div class="col-12 d-flex align-items-center">
                        <h6 class="text-white mb-3">Ngân sách thưởng</h6>
                    </div>
                </div>
            </div> 
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="ngan_sach_thuong" class="form-control-label">Ngân sách thưởng đạt được <sup style="color:red">{{($quanLy ? '(1)' :'')}}</sup> </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_ngan_sach_thuong - $tongNganSachThuongCaTeam *40/100)}}" aria-label="Ngân sách thưởng" aria-describedby="ngan_sach_thuong_value" readonly id="ngan_sach_thuong_value">
                                
                            </div>                                    
                        </div>                              
                    </div> 
                    @if($quanLy)  
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="ngan_sach_thuong_cua_team" class="form-control-label">Ngân sách thưởng cả team đạt được  <sup style="color:red"> {{($quanLy ? '(2)' :'')}} </sup></label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($tongNganSachThuongCaTeam)}}" aria-label="Ngân sách thưởng" aria-describedby="ngan_sach_thuong_cua_team" readonly id="ngan_sach_thuong_cua_team">
                                
                            </div>                                    
                        </div>                              
                    </div> 
                    @endif
                   
                </div>
            </div>
            <div class="card-footer bg-secondary">
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="ngan_sach_thuong_da_nhan" class="form-control-label text-white">Tổng ngân sách thưởng  <sup style="color: darkred"> {{$quanLy ? '( (1) + (2) x 40%)' :'' }}</sup></label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_ngan_sach_thuong)}}" aria-label="Ngân sách thưởng" aria-describedby="ngan_sach_thuong_da_nhan" readonly id="ngan_sach_thuong_da_nhan">
                            
                        </div>                                    
                    </div>                              
                </div> 
            </div>
        </div>
    </div>