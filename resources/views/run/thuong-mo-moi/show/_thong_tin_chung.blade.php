<div class="col-xs-12">
    <!-- begin card info -->
    <div class="card">
        <div class="card-header pb-0 p-3 bg-dark">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="text-white mb-3">Thưởng mở mới tháng {{$thangNamThuong->thang}} năm {{$thangNamThuong->nam}}</h5>
                </div>
                <div class="col-6 text-end">
                    <a href="{{route('thuong-mo-moi.index')}}" class="btn btn-secondary btn-md mb-2"><i class="fas fa-undo" aria-hidden="true"></i> Quay về</a> 
                    
                </div>
                
            </div>
        </div>
        <div class="card-body">
            <div class="row">
            <div class="form-group col-12 col-md-6">
                <label for="thang_su_dung" class="form-control-label">Tháng tính thưởng</label>
                <div class="input-group mb-3">
                
                    <select name="thang_su_dung" id="thang_su_dung" aria-label="Tháng" placeholder="Thời gian áp dụng" class="form-control ">
                    
                        @foreach ($dsThangNam as $thang)
                            <option value="{{$thang->id}}" data-url="{{route('thuong-mo-moi.show',['thuong_mo_moi'=>$thang])}}" 
                            @if($thang->id_thang_nam == $thuongMoMoi->id_thang_nam)
                                selected
                            @endif
                            >Tháng {{$thang->thangNam->thang}}/{{$thang->thangNam->nam}}</option>
                        @endforeach
                        
                    </select>
                    <button id='btn_thuong_thang_chon' class="btn btn-primary btn-md mb-0" type="button" id="button-ngan-sach">
                        <div class="d-flex align-items-center">   
                            Xem <span class='material-icons '>arrow_right_alt</span>
                        </div>
                    </button>
                </div>
                @error('thang_su_dung')
                    <span class="help text-danger"> {{ $message}}</span>
                @enderror
            </div>
           
            </div>
            <div class="row">
              
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="thang_su_dung" class="form-control-label">Tiền thưởng mở mới được nhận trong kì</label>
                        
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{thuGonSoLe($thuongMoMoi->so_tien_thuong_mo_moi)}}" aria-label="Tổng tiền thưởng" aria-describedby="button-tong-thuong" readonly id="tong_tien_thuong_dat_duoc_value">
                            <button onclick="tinhTongTienThuong('{{route('thuong-nhan-vien.tinhTongTienThuong',['thuongNhanVien'=>$thuongMoMoi])}}')" class="btn btn-warning btn-md mb-0" type="button" id="button-tong-thuong">
                                <div class="d-flex align-items-center">         
                                    <span class='material-icons '>update</span>
                                    Tính lại
                                </div>
                            </button>
                        </div>                                    
                    </div>                              
                </div>                                                     
            </div>  
        </div>
    </div>
    <!-- end card info-->                    
</div>
@push('scripts')
<script defer>
    document.querySelector('#btn_thuong_thang_chon').addEventListener('click',()=>{
        let urlThuong = "{{url('thuong-mo-moi')}}/"+document.querySelector('#thang_su_dung').value;
        window.open(urlThuong);
    });
</script>
@endpush