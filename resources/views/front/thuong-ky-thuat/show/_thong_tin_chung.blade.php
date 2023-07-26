<div class="col-xs-12">
    <!-- begin card info -->
    <div class="card">
        <div class="card-header pb-0 p-3 bg-dark">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="text-white mb-3">Thông tin thưởng tháng {{$thangNamThuong->thang}} năm {{$thangNamThuong->nam}}</h5>
                </div>
                <div class="col-6 text-end">
                    <a href="{{route('thuong-ky-thuat.index')}}" class="btn btn-secondary btn-md mb-2"><i class="fas fa-undo" aria-hidden="true"></i> Quay về</a> 
                    <?php /*
                    @if($thuongNhanVien->thuongQuyTuongUng() == null ) 
                        <a href="{{route('thuong-thoi-gian.khoi-tao-quy',['thuongNhanVien'=>$thuongNhanVien])}}"  class="btn btn-warning btn-md mb-2" type="button" id="button-tong-thuong"><div class="d-flex align-items-center">
                            <span class='material-icons'>edit_note</span>
                                Tạo thông tin thưởng quý
                            </div>
                        </a>
                    @else 
                        <a href="{{route('thuong-thoi-gian.show', ['thuongKhoangThoiGian'=>$thuongNhanVien->thuongQuyTuongUng()])}}"  class="btn btn-info btn-md mb-2"><div class="d-flex align-items-center">
                            <span class='material-icons'>edit_note</span>
                                Xem thông tin thưởng quý
                            </div>
                        </a>
                        @if($thuongNhanVien->thuongNamTuongUng() != null )
                            <a href="{{route('thuong-nam.show',['thuongNam'=>$thuongNhanVien->thuongNamTuongUng()])}}"  class="btn btn-warning btn-md mb-2"><div class="d-flex align-items-center">
                                <span class='material-icons'>edit_note</span>
                                    Xem thưởng năm
                                </div>
                            </a>
                        @endif
                    @endif 
                */?>
                
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
                            <option value="{{$thang->id}}"  
                            @if($thang->id_thang_nam == $thuongNhanVien->id_thang_nam)
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
            <div class="form-group col-12 col-md-6">
                @can('edit_thuongnhanvien')
                    <label for="trang_thai_khoa" class="form-control-label">Trạng thái</label>
                    <div class="input-group mb-3">
                    <?php 
                    $khoaRoute = route('thuong.nhan-thuong',['thuongNhanVien'=>$thuongNhanVien, 'action'=>'khoa']);
                    $moKhoaRoute = route('thuong.nhan-thuong',['thuongNhanVien'=>$thuongNhanVien,'action'=>'mo-khoa']);
                    if($thuongNhanVien->daKhoa()) {
                        $activeRoute = $khoaRoute;
                    } else {
                        $activeRoute = $moKhoaRoute;
                    }
                        
                    
                    
                    ?>
                    <x-trang-thai-switch
                        :url1="$khoaRoute"
                        label1="Khóa"
                        :url2="$moKhoaRoute"
                        label2="Mở khóa"
                        :active="$activeRoute"
                        />
                    </div>
                @endcan
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="ngan_sach_thuong" class="form-control-label">Ngân sách thưởng</label>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{thuGonSoLe($thuongNhanVien->ngan_sach_thuong)}}" aria-label="Ngân sách thưởng" aria-describedby="button-ngan-sach" readonly id="ngan_sach_thuong_value">
                            <button onclick="tinhNganSachThuong('{{route('thuong-ky-thuat.tinhLaiNganSach',['thuongNhanVien'=>$thuongNhanVien])}}')" class="btn btn-warning btn-md mb-0" type="button" id="button-ngan-sach">
                            <div class="d-flex align-items-center">         
                                <span class='material-icons '>update</span>
                                Tính lại
                            </div>
                            </button>
                        </div>                                    
                    </div>                              
                </div>   
        
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label for="thang_su_dung" class="form-control-label">Số tiền thưởng được nhận trong kì</label>
                        
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{thuGonSoLe($thuongNhanVien->tong_tien_thuong_dat_duoc)}}" aria-label="Tổng tiền thưởng" aria-describedby="button-tong-thuong" readonly id="tong_tien_thuong_dat_duoc_value">
                            <button onclick="tinhTongTienThuong('{{route('thuong-nhan-vien.tinhTongTienThuong',['thuongNhanVien'=>$thuongNhanVien])}}')" class="btn btn-warning btn-md mb-0" type="button" id="button-tong-thuong">
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
        let urlThuong = "{{url('thuong-ky-thuat')}}/"+document.querySelector('#thang_su_dung').value;
        window.open(urlThuong,'_self');
    });
</script>
@endpush