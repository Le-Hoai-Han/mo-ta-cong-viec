
    <div class="col-xl-4 col-md-2">
        <div class="card">
            <div class="card-header pb-0 p-3 bg-danger">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="text-white mb-3">Nợ xấu</h6>
                    </div>
                </div>
            </div> 
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tong_tien_no_xau" class="form-control-label">Tổng tiền nợ xấu </label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tong_no_xau_phai_tru)}} " aria-label="Tổng tiền nợ xấu phải trừ" aria-describedby="tong_no_xau_phai_tru" readonly id="tong_no_xau_phai_tru">
                                
                            </div>                                    
                        </div>                              
                    </div>
            
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tien_no_xau_phai_tru" class="form-control-label">5% Tổng tiền nợ xấu</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($thuongKhoangThoiGian->tien_no_xau_phai_tru)}}" aria-label="Tổng tiền nợ xấu phải trừ" aria-describedby="tien_no_xau_phai_tru" readonly id="tien_no_xau_phai_tru">
                                
                            </div>                                    
                        </div>                              
                    </div>
            
                </div>
                @if($quanLy)
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tong_no_xau_cua_team" class="form-control-label">Tổng tiền nợ xấu của team</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($tienNoXauCuaTeam)}}" aria-label="Tổng tiền nợ xấu của team phải trừ" aria-describedby="tong_no_xau_cua_team" readonly id="tong_no_xau_cua_team">
                                
                            </div>                                    
                        </div>                              
                    </div>
            
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <label for="tien_no_xau_cua_team" class="form-control-label">5% Tổng tiền nợ xấu của team</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($tienNoXauCuaTeam * 0.05)}}" aria-label="Tổng tiền nợ xấu phải trừ" aria-describedby="tien_no_xau_cua_team" readonly id="tien_no_xau_cua_team">
                                
                            </div>                                    
                        </div>                              
                    </div>
            
                </div>
                @endif

                {{-- <div class="row">
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="tong_tien_no_xau" class="form-control-label">Tổng tiền nợ xấu của team</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($tienNoXauCuaTeam)}}" aria-label="Tổng tiền nợ xấu phải trừ" aria-describedby="tong_no_xau_phai_tru" readonly id="tong_no_xau_phai_tru">
                                
                            </div>                                    
                        </div>                              
                    </div>
            
                    <div class="col-12 col-md-12">
                        <div class="form-group">
                            <label for="tien_no_xau_phai_tru" class="form-control-label">5% Tổng tiền nợ xấu của team</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" value="{{thuGonSoLe($tienNoXauCuaTeam * 0.05)}}" aria-label="Tổng tiền nợ xấu phải trừ" aria-describedby="tien_no_xau_phai_tru" readonly id="tien_no_xau_phai_tru">
                                
                            </div>                                    
                        </div>                              
                    </div>
            
                </div> --}}
            </div>
            <div class="card-footer bg-secondary">

            </div>
        </div>
    </div>