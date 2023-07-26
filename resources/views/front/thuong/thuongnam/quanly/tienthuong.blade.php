    <div class="col-xl-6 col-md-3 mt-4">
        <div class="card">
            <div class="card-header pb-0 p-3 bg-info">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="text-white mb-3">Tiền thưởng</h6>
                    </div>
                </div>
            </div> 
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="tong_tien_thuong_dat_duoc" class="form-control-label">Tổng tiền thưởng đạt được</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_tien_thuong_dat_duoc)}}" aria-label="Tổng tiền thưởng đạt được" aria-describedby="tong_tien_thuong_dat_duoc" readonly id="tong_tien_thuong_dat_duoc">
                                
                            </div>                                    
                        </div>                              
                    </div>

                    <div class="col-12 col-md-12"> 
                        <div class="form-group">
                            <label for="tong_tien_thuong_da_nhan" class="form-control-label">Tổng tiền thưởng đã nhận trong kì</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_tien_thuong_da_nhan)}}" aria-label="Tổng tiền thưởng đã nhận trong kì" aria-describedby="tong_tien_thuong_da_nhan" readonly id="tong_tien_thuong_da_nhan">
                                
                            </div>                                    
                        </div>                            
                    </div>
                     
                </div>
            </div>
            <div class="card-footer bg-secondary">
                <div class="col-12 col-md-12">
                    <div class="form-group">
                        <label for="tong_tien_thuong_con_lai" class="form-control-label text-white">Tổng tiền thưởng còn lại</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tien_thuong_con_lai)}}" aria-label="Tổng tiền thưởng đã nhận" aria-describedby="tong_tien_thuong_con_lai" readonly id="tong_tien_thuong_con_lai">
                            
                        </div>                                    
                    </div>                              
                </div>
            </div>
        </div>
    </div>