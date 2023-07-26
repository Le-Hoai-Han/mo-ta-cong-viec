<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-xl-4">Danh sách đơn hàng</div>
                        <div class="col-12 col-xl-8 text-end">
                            @if(auth()->user()->hasRole('admin'))
                            <a class="btn btn-info btn-md mb-0" href="{{route('donhang.requestStoring')}}">Cập nhật danh sách</a>
                            @endif
                            <a class="btn btn-warning btn-md mb-0" href="{{route('donhang.capNhatThuong')}}">Cập nhật thưởng</a>
                            <a class="btn btn-warning btn-md mb-0" href="{{route('donhang.tinhTatCa')}}">Tính tất cả</a>
                            @if(auth()->user()->can('add_orders'))
                            <a href={{route('don-hang.create')}} class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm đơn hàng</a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body over-flow-y" >
                    @if ($errors->any())
                        <div class="alert alert-danger" style="width: fit-content">
                                @foreach ($errors->all() as $error)
                                    <span style="color:white">{{ $error }}</span>
                                @endforeach
                        </div><br>
                    @endif          
                    @if(Session::has('error'))
                    <div style="color:white;width: fit-content" class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-success" style="width: fit-content">{{Session::get('success')}}</div>
                    @endif 

                    @if(auth()->user()->hasRole('admin'))
                    
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="ma_don_hang_tra_cuu">Kiểm tra đơn hàng</label>
                                    <input type="text" value="" name="ma_don_hang_tra_cuu" id="ma_don_hang_tra_cuu" class="form-control" aria-describedby="">
                                </div>
                            </div>
                            <div class="col-12 col-md-8" >
                                <div class="form-group">
                                    <button class="btn btn-info btn-md mb-3" type="button" id="btn_form_tra_cuu_don_hang">
                                        Kiểm tra đơn hàng
                                    </button>
                                </div>
                            </div>                          
                        </div>
                    
                    @endif

                    <div class="row">
                        <div class="col-12 col-md-8" style="padding: 0px" >
                            <div class="form-group" style="margin: 0px">
                               <button onclick="hideShowMenuSearch()" class="btn btn-facebook" style="display: flex">Lựa chọn điều kiện lọc <span class="material-icons">arrow_drop_down</span></button>
                            </div>
                        </div> 
                        <form method="get" action="" class="col-6" id="" name="">
                        <div class="col-12 col-md-8">
                            <div class="row form-search" id="form_dieu_kien_loc" >
                                <div class="col-6 col-md-6">
                                    <div class="item">
                                        <label for="">Mã đơn hàng</label>
                                        <input type="text" name="ma_don_hang" value="<?php echo ($maDonHang != '%%'? $maDonHang :'') ?>" id="ma_don_hang" class="form-control" placeholder="Nhập mã đơn hàng">
                                    </div>
                                    <div class="item">
                                        <label for="">Người tạo</label>
                                        <input autocomplete="off" type="text" name="nguoi_tao_don" value="<?php echo ($nguoiTaoDon != '%%'? $nguoiTaoDon:'') ?>" id="nguoi_tao_don" class="form-control" placeholder="Tên người tạo " onkeyup="filterFunction()" onclick="showSelecteUser()">
                                        <div id="div_user">
                                                @foreach($users as $user)
                                                       <a id="{{$user->id}}" class="item_user_name" onclick="setValueInPutNguoiTaoDon({{$user->id}})">{{$user->name}}</a>
                                                @endforeach
                                        </div>
                                    </div>
                                   
                                    <div class="item">
                                        <label for="">Theo ngày đặt hàng</label>
                                        <input type="checkbox" {{($type_ngay_thanh_toan == 1 ? '':'checked')}} value="{{($type_ngay_dat_hang == 1 ? 1:0)}}" name="type_ngay_dat_hang" id="type_ngay_dat_hang" onclick="if(this.checked){changeValueInPutNgayDatHang(1)}else{changeValueInPutNgayDatHang(0)}">
                                    </div>
                           
                                    <div class="item">
                                        <label for="ngay_kt">Từ ngày</label>
                                        <input type="text" value="<?php echo $ngayBD ?>" name="ngayBD" id="ngay_bd" class="form-control" aria-describedby="tu-ngay" format="dd/mm/yyyy">
                                    </div>
                                               </div>
                                <div class="col-6 col-md-6">
                                    <div class="item">
                                        <label for="">Trạng thái</label>
                                       
                                        <select name="trang_thai" id="trang_thai" class="form-control">
                                            @foreach($listTrangThai as $key=> $item)
                                                @if($key == $trangThai )
                                                    <option selected value="{{$key}}">{{$item}}</option>
                                                @else
                                                    <option value="{{$key}}">{!!$item!!}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="item">
                                        <label for="">Trạng thái thanh toán </label>
                                        <select name="trang_thai_thanh_toan" id="trang_thai_thanh_toan" class="form-control">
                                            @foreach($listTrangThaiThanhToan as $key=> $item)
                                                @if($key == $trangThaiThanhToan )
                                                    <option selected value="{{$key}}">{{$item}}</option>
                                                @else
                                                    <option value="{{$key}}">{{$item}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="item">
                                        <label for="">Theo ngày thanh toán</label>
                                        <input type="checkbox" {{($type_ngay_thanh_toan ==1 ?'checked':'')}} value="{{($type_ngay_thanh_toan ==1 ? 1:0)}}" name="type_ngay_thanh_toan" id="type_ngay_thanh_toan" onclick="if(this.checked){changeValueInPutNgayThanhToan(1)}else{changeValueInPutNgayThanhToan(0)}">
                                    </div>
                                    <div class="item">
                                        <label for="ngay_kt">Đến ngày</label>
                                        <input type="text" value="<?php echo $ngayKT ?>" name="ngayKT" id="ngay_kt" class="form-control" format="dd/mm/yyyy" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                                <div class="col-6 col-md-6" onclick="displayNoneAllOption()" >
                                    <div class="item">
                                        <br>
                                        <button class="btn btn-info btn-md mb-3" type="submit" id="button-ngan-sach">
                                            Tra cứu
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6 col-md-6" onclick="displayNoneAllOption()">
                                    <div class="item">
                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div> 
                        </form>                          
                    </div>                     
                        <table class="table table-bordered " id="order-table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Mã đơn hàng </th>
                                    <th>Người tạo</th>
                                    <th>Doanh số/Doanh thu<br>(VNĐ)</th>
                                    <th>Tiền thưởng<br>(VNĐ)</th>
                                    <th>Đã thanh toán</th>
                                    {{-- <th>Ngày tạo đơn</th>  --}}
                                    <!-- <th>Ngày bắt đầu tính thời hạn</th>
                                    <th>Ngày kết thúc tính thưởng</th>
                                    <th>Được tính thưởng</th> -->
                                    <!-- <th>Trạng thái</th> -->
                                    {{-- <th>Đã cập nhật</th> --}}
                                    <th>Ngày tạo<br>/Ngày nghiệm thu</th>
                                    {{-- <th>Cập nhật</th> --}}
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                        </table>

                        @push('styles')
                            <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
                            <style>
                                .form-search{
                                    width: 500px;
                                    /* height: 200px; */
                                    /* background-color: #e2d7d7b9; */
                                    padding: 10px;
                                    border: solid 1px #ccc;
                                    border-radius: 5px;
                                    display: none;
                                    position: absolute;
                                }
                                .show{
                                display: flex;
                                transition: ease-in-out .5s;
                                position: absolute;
                                background: #fff;
                                z-index: 1;
                    
                                }

                                #div_user{
                                    display: none;
                                    flex-direction: column;
                                    overflow-y: scroll;
                                    max-height: 200px;
                                    margin: 5px 8px;
                                    position: absolute;
                                    background-color: #fff
                                }
                                .item_user_name{
                                    display: flex;
                                    min-height: 40px;
                                    padding: 5px 20px;
                                    background-color: #fff;
                                    align-items: center;
                                    border: solid 1px #9c9a9a;
                                    font-size: 13px;
                                    cursor: pointer;
                                }
                                .item_user_name:hover{
                                    background-color: rgb(127, 193, 255);
                                    color: #fff
                                }
                                
                                /* custom scrollbar  */
                                /* width */
                                ::-webkit-scrollbar {
                                width: 10px;
                                }

                                /* Track */
                                ::-webkit-scrollbar-track {
                                background: #f1f1f1; 
                                }
                                
                                /* Handle */
                                ::-webkit-scrollbar-thumb {
                                background: #888; 
                                }

                                /* Handle on hover */
                                ::-webkit-scrollbar-thumb:hover {
                                background: #555; 
                                }

                            </style>
                        @endpush
                        @push('scripts')
                            <script src="{{ asset('datatable/datatables.min.js') }}"></script>
                            <script>
                            let ngay_bd=document.querySelector('#ngay_bd').value;
                            let ngay_kt=document.querySelector('#ngay_kt').value;
                            let ma_don_hang=document.querySelector('#ma_don_hang').value;
                            let nguoi_tao_don=document.querySelector('#nguoi_tao_don').value;
                            let trang_thai=document.querySelector('#trang_thai').value;
                            let trang_thai_thanh_toan=document.querySelector('#trang_thai_thanh_toan').value;
                            let type_ngay_dat_hang=document.querySelector('#type_ngay_dat_hang').value;
                            let input_ngay_dat_hang=document.querySelector('#type_ngay_dat_hang');
                            let type_ngay_thanh_toan=document.querySelector('#type_ngay_thanh_toan').value;
                            let input_ngay_thanh_toan=document.querySelector('#type_ngay_thanh_toan');
                           
                            function changeValueInPutNgayDatHang(item){
                                if(item ==1){
                                    input_ngay_dat_hang.value =1;
                                }else{
                                    input_ngay_dat_hang.value =0;
                                }
                            }

                            function changeValueInPutNgayThanhToan(item){
                                if(item ==1){
                                    input_ngay_thanh_toan.value =1;
                                }else{
                                    input_ngay_thanh_toan.value =0;
                                }
                            }
                        
                            $(function() {
                                $('#order-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax: '{!!url('don-hang/data') !!}?ngayBD='+ngay_bd+"&ngayKT="+ngay_kt+"&maDonHang="+ma_don_hang+"&nguoiTaoDon="+nguoi_tao_don
                                    +"&trangThai="+trang_thai+"&trangThaiThanhToan="+trang_thai_thanh_toan+"&typeNgayDatHang="+type_ngay_dat_hang+"&typeNgayThanhToan="+type_ngay_thanh_toan,
                                    oLanguage:{
                                        sSearch:"Tìm kiếm:",
                                        sshow:"Hiển thị", 
                                        sProcessing: "Đang tải dữ liệu",
                                        sZeroRecords: "Không tìm thấy kết quả",
                                        oPaginate:{
                                                    sNext: ">",
                                                    sPrevious:"<"
                                                },
                                        sEmptyTable:"Chưa có dữ liệu",
                                        sInfo:"Hiển thị từ _START_ đến _END_ trong tổng số  _TOTAL_ sản phẩm",
                                        sInfoEmpty:"Không tìm thấy kết quả nào",
                                        sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                                        sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                                        sLengthMenu:"Hiển thị _MENU_ kết quả"
                                    },
                                    columns: [
                                        { data: 'id', name: 'id', className:'text-center' },
                                        { data: 'ma_don_hang', name: 'ma_don_hang' },
                                        { data: 'ten_nguoi_tao', name: 'ten_nguoi_tao' },
                                        { data: 'doanh_so', name: 'doanh_so' },
                                        { data: 'tien_thuong_don_hang', name: 'tien_thuong_don_hang' },
                                        { data: 'thong_tin_thanh_toan', name: 'thong_tin_thanh_toan' },
                                        // { data: 'ngay_tao_don', name: 'ngay_tao_don' },
                                        // { data: 'ngay_bat_dau_tinh_thoi_han', name: 'ti_le_thuong' },
                                        // { data: 'ngay_ket_thuc_tinh_thuong', name: 'ti_le_thuong' },
                                        // { data: 'duoc_tinh_thuong', name: 'ti_le_thuong' },
                                        // { data: 'trang_thai', name: 'ti_le_thuong' },
                                        // { data: 'da_cap_nhat', name: 'da_cap_nhat' },
                                        { data: 'ngay_tao_don', name: 'ngay_tao_don' },
                                        // { data: 'updated_at', name: 'updated_at' },
                                        {data: 'action', name: 'action', orderable: false, searchable: false},
                                        
                                    ],
                                });
                            });
                            
                            document.querySelector("#btn_form_tra_cuu_don_hang").addEventListener('click',(e)=>{
                                let maDonHang = document.querySelector('#ma_don_hang_tra_cuu');
                                if(maDonHang) {
                                    console.log(maDonHang.value); 
                                   
                                    
                                    let urlTraCuu = "{{ route('donHangGetfly.show') }}/"+ maDonHang.value;
                                    window.open(urlTraCuu,'_self');
                                }
                                
                            })

                            // Ẩn hiện menu tìm kiếm
                            function hideShowMenuSearch(){
                                let form_dieu_kien_loc=document.querySelector('#form_dieu_kien_loc');
                                form_dieu_kien_loc.classList.toggle('show')
                            }

                            // Show list User
                            function showSelecteUser(){
                                document.getElementById('div_user').style.display='flex';
                            }

                            // Tìm kiểm theo tên người tạo
                            function filterFunction() {
                                var input, filter, ul, li, a, i;
                                input = document.getElementById("nguoi_tao_don");
                                filter = input.value.toUpperCase();
                                div = document.getElementById("div_user");
                                a = div.getElementsByTagName("a");
                                for (i = 0; i < a.length; i++) {
                                    txtValue = a[i].textContent || a[i].innerText;
                                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                    a[i].style.display = "";
                                    } else {
                                    a[i].style.display = "none";
                                    }
                                }
                                }

                            // gán giá trị cho input người tạo đơn
                            function setValueInPutNguoiTaoDon(id){
                                document.getElementById('div_user').style.display='none';
                                input_nguoi_tao_don = document.getElementById("nguoi_tao_don");
                                let item_select_user= document.getElementById(id);
                                input_nguoi_tao_don.value =item_select_user.textContent;
                            }

                            // Đóng tất cả các option đang hiển thị khi click ngoài input
                            function displayNoneAllOption(){
                                div = document.getElementById("div_user");
                                div.style.display='none';
                            }

                            
                            if(input_ngay_dat_hang.checked == true){
                                input_ngay_dat_hang.value = 1;
                            }else{
                                input_ngay_dat_hang.value = 0;
                            }
                            </script>
                        @endpush
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>