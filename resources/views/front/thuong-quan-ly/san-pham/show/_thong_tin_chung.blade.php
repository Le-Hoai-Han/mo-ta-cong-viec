<x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-dark text-white "> 
    <x-slot name="title">
        <h6 class="text-white">
            Thông tin tiền thưởng
        </h6>
    </x-slot>
    <x-slot name="button">
        <a href="{{url()->previous()}}" class='btn btn-secondary'>Quay về</a>
        

    </x-slot>
    <div class="row">
            <div class="form-group col-12">
                <label for="thang_su_dung" class="form-control-label">Tháng tính thưởng</label>
                <div class="input-group mb-3">
                
                    <select name="thang_su_dung" id="thang_su_dung" aria-label="Tháng" placeholder="Thời gian áp dụng" class="form-control ">
                    
                        @foreach ($dsThuong as $thuong)
                            <option value="{{$thuong->id}}" data-url="{{route('thuong-quan-ly.san-pham.show',['thuongSanPhamQuanLy'=>$thuong])}}" 
                            @if($thuong->id == $thuongSanPhamQuanLy->id)
                                selected
                            @endif
                            >Tháng {{$thuong->thang}}/{{$thuong->nam}}</option>
                        @endforeach
                        
                    </select>
                    <button id='btn_thuong_thang_chon' class="btn btn-primary btn-md mb-0" type="button" id="button-ngan-sach">
                        <div class="d-flex align-items-center">   
                            Xem <span class='material-icons '>arrow_right_alt</span>
                        </div>
                    </button>
                </div>
                
            </div>
            
            <div class="col-12">
                <div class="form-group">
                    <label for="ngan_sach_thuong" class="form-control-label">Số tiền thưởng</label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" value="{{thuGonSoLe($thuongSanPhamQuanLy->so_tien_thuong)}}" aria-label="Ngân sách thưởng" aria-describedby="button-ngan-sach" readonly id="so_tien_thuong">
                        
                    </div>                                    
                </div>                              
            </div>   
            <div class="form-group col-12">
                @can('edit_quanlysanphams')
                    <label for="trang_thai_khoa" class="form-control-label">Trạng thái</label>
                    <div class="input-group mb-3">
                        <?php 
                        $khoaRoute = route('thuong-quan-ly.san-pham.khoa-thuong',['thuong'=>$thuongSanPhamQuanLy, 'trangThai'=>'khoa']);
                        $moKhoaRoute = route('thuong-quan-ly.san-pham.khoa-thuong',['thuong'=>$thuongSanPhamQuanLy,'trangThai'=>'mo-khoa']);
                        if($thuongSanPhamQuanLy->daKhoa()) {
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
</x-simple-card>
@push('scripts')
    <script >
            
        function capNhatThongTinThuong() {
            const url = "{{route('thuong-quan-ly.san-pham.cap-nhat',['thuong'=>$thuongSanPhamQuanLy])}}";

            $.ajax({
                url: url,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                },
                success:function(res) {     
                    location.reload();           
                }
            });
        }

        document.querySelector('#btn_thuong_thang_chon').addEventListener('click',()=>{
            let urlThuong = "{{url('thuong-quan-ly/san-pham/')}}/"+document.querySelector('#thang_su_dung').value;
            window.open(urlThuong,'_self');
        });
    </script>

@endpush