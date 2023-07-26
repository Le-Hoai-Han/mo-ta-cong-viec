<div class="row mt-5">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Nhật ký cập nhật</h5>
                </div>
               
                    @foreach($dataNhatKy as $nhatKy)
                    <div class="card mt-3 mb-3">
                        <div class="card-header">
                        <h6>Ngày {{date_format($nhatKy->updated_at,'d-m-Y H:i:s')}}</h6>
                        </div>
                        <div class="card-body">
                        
                        @foreach($nhatKy->nguoiThayDoi as $nk)
                        Người thay đổi : <p><b>{{$nk->ho_ten}}</b></p>

                        Nội dung mới:<br>
                        Doanh số: 
                        <b>{{explode(',',$nhatKy->noi_dung_moi)[0]}}</b><br>
                        Doanh thu: 
                        <b>{{explode(',',$nhatKy->noi_dung_moi)[1]}}</b><br>
                        Nội dung cũ:<br>
                        Doanh số: 
                        <b>{{explode(',',$nhatKy->noi_dung_cu)[0]}}</b><br>
                        Doanh thu :
                        <b>{{explode(',',$nhatKy->noi_dung_cu)[1]}}</b><br>
                       
                        @endforeach
                        </div>
                    </div>
                    
                    @endforeach
            </div>
        </div>
    </div>