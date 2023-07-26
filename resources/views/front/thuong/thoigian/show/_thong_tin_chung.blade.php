<div class="col-xs-12">
    <!-- begin card info -->
    <div class="card">
        <div class="card-header pb-0 p-3 bg-dark">
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <h5 class="text-white mb-3">Thông tin thưởng quý {{$thuongKhoangThoiGian->quy}} năm {{$thuongKhoangThoiGian->nam}}</h5>
                </div>
                <div class="col-6 text-end">
                 
                    <x-base-link :route="route('thuong-thoi-gian.index')" colorClass="secondary" label="Danh sách thưởng quý" icon="list"/>
                    <x-base-link :route="route('thuong-nhan-vien.index',['id'=>$thuongKhoangThoiGian->id])" colorClass="info" label="Thưởng tháng nhân viên" icon="list"/>
                    @if($thuongKhoangThoiGian->thuongNamTuongUng() != null )
                        <a href="{{route('thuong-nam.show',['thuongNam'=>$thuongKhoangThoiGian->thuongNamTuongUng()])}}" class="btn btn-warning btn-md mb-2"><div class="d-flex align-items-center">
                            <span class='material-icons'>edit_note</span>
                                Xem thưởng năm
                            </div>
                        </a>
                        
                    @endif
                </div>
                </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="form-group col-12 col-md-6">
                    <label for="thang_su_dung" class="form-control-label">Thời gian áp dụng</label>
                    <div class="input-group mb-3">
                    
                        <select name="quy_su_dung" id="quy_su_dung" aria-label="Thời gian áp dụng" placeholder="Thời gian áp dụng" class="form-control ">
                        
                            @foreach ($dsQuyTinhThuong as $thuongQuyNhanVien)
                                <option value="{{$thuongQuyNhanVien->id}}" 
                                data-url="{{route('thuong-thoi-gian.show',$thuongKhoangThoiGian)}}" 
                                @if($thuongQuyNhanVien->id == $thuongKhoangThoiGian->id)
                                    selected
                                @endif
                                >Quý {{$thuongQuyNhanVien->quy}} năm {{$thuongQuyNhanVien->nam}}</option>
                            @endforeach
                            
                        </select>
                        <button id='btn_thuong_quy_chon' class="btn btn-primary btn-md mb-0" type="button" id="button-ngan-sach">
                            <div class="d-flex align-items-center">   
                                Xem <span class='material-icons '>arrow_right_alt</span>
                            </div>
                        </button>
                    </div>
                   
                </div>
                <div class="form-group col-12 col-md-6">
                    @can('edit_thuongnhanvien')
                    <label for="trang_thai_khoa" class="form-control-label">Trạng thái</label>
                    <div class="input-group mb-3">
                    <?php 
                    $khoaRoute = route('thuong-thoi-gian.khoa-thuong',['thuongKhoangThoiGian'=>$thuongKhoangThoiGian, 'trangThai'=>'khoa']);
                    $moKhoaRoute = route('thuong-thoi-gian.khoa-thuong',['thuongKhoangThoiGian'=>$thuongKhoangThoiGian,'trangThai'=>'mo-khoa']);
                    if($thuongKhoangThoiGian->daKhoa()) {
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
                <div class="form-group col-12 col-md-6">
                    <?php /*
                    <label for="thang_su_dung" class="form-control-label">Trạng thái</label>
                    <div class="input-group mb-3">
                            <input type="text" class="form-control" value="{{$thuongKhoangThoiGian->trang_thai_khoa}}" aria-label="Ngân sách thưởng" aria-describedby="trang_thai_khoa" readonly id="ngan_sach_thuong_value">
                            
                        
                        <button id='btn_thuong_quy_chon' class="btn btn-primary btn-md mb-0" type="button" id="button-ngan-sach">
                            <div class="d-flex align-items-center">   
                                Xem <span class='material-icons '>arrow_right_alt</span>
                            </div>
                        </button>
                    </div>*/?>
                    
                </div>
                
            </div>
           <?php /*  @include('front.thuong.thoigian.show.__thong_tin_tien_thuong',[
                    'thuongKhoangThoiGian'=>$thuongKhoangThoiGian,
                    ])       */ ?>

            
        </div>
    </div>
    <!-- end card info-->                    
</div>
@push('scripts')
<script defer>
    document.querySelector('#btn_thuong_quy_chon').addEventListener('click',()=>{
        let urlThuong = "{{url('thuong-thoi-gian')}}/"+document.querySelector('#quy_su_dung').value;
        window.open(urlThuong,"_self");
    });
    
</script>
@endpush