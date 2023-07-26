<?php 
$current = "Thông tin thưởng nhân viên";
$list = [    
    url('/thuong-nhan-vien')=>'Danh sách thông tin thưởng nhân viên'    
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >           
            <div class="col-12 col-md-5">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-8 d-flex align-items-center">
                                <h6 class="mb-0">Thông tin tính thưởng</h6>
                            </div>
                            <div class="col-4 text-end">                                
                                
                                {{-- <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                  <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div> --}}
                                <a style="cursor: pointer" href="{{route('thuong-nhan-vien.create')}}" class="icon icon-shape bg-gradient-success shadow-primary text-center rounded-circle">
                                    <i class="ni ni-fat-add text-xl opacity-10" aria-hidden="true"></i>
                                </a>
                                <a style="cursor: pointer" id="delete_info_thuong" class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-fat-delete text-xl opacity-10" aria-hidden="true"></i>
                                </a>
                              </div>
                        </div>
                        <div class="col-12 alert alert-danger text-white mt-3" id="general-info" style="display: none"></div>
                    </div>
                    <div class="card-body">                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ten_nhan_vien" class="form-control-label">Tên nhân viên</label>
                                    <input class="form-control" type="text" value="{{$thuongNhanVien->nhanVien->ho_ten}} - {{$thuongNhanVien->nhanVien->user->email}}" name="ten_nhan_vien" id="ten_nhan_vien"  onfocus="focused(this)" onfocusout="defocused(this)" readonly>
                                </div>                            
                            </div>                                                     
                        </div>  
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="thang_su_dung" class="form-control-label">Nhóm nhân viên</label>
                                    <input class="form-control" type="text" value="{{$thuongNhanVien->nhanVien->group}}" readonly>
                                </div>                              
                            </div>                                                     
                        
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label for="thang_su_dung" class="form-control-label">Thời gian áp dụng</label>
                                    <input class="form-control" type="text" value="{{"Tháng ".$thuongNhanVien->thangNam->thang." năm ".$thuongNhanVien->thangNam->nam}}" readonly>
                                </div>                              
                            </div>                                                     
                        </div> 
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="ngan_sach_thuong" class="form-control-label">Ngân sách thưởng</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" value="{{$thuongNhanVien->ngan_sach_thuong}}" aria-label="Ngân sách thưởng" aria-describedby="button-ngan-sach" readonly id="ngan_sach_thuong_value">
                                        <button onclick="tinhNganSachThuong('{{route('thuong-nhan-vien.tinhNganSachThuong',['thuongNhanVien'=>$thuongNhanVien])}}')" class="btn btn-info btn-md mb-0" type="button" id="button-ngan-sach">
                                            <span class='material-icons '>calculate</span>
                                        </button>
                                    </div>                                    
                                </div>                              
                            </div>   
                                                                              
                        </div>  
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="thang_su_dung" class="form-control-label">Số tiền thưởng đạt được</label>
                                    
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" value="{{$thuongNhanVien->tong_tien_thuong_dat_duoc}}" aria-label="Tổng tiền thưởng" aria-describedby="button-tong-thuong" readonly id="tong_tien_thuong_dat_duoc_value">
                                        <button onclick="tinhTongTienThuong('{{route('thuong-nhan-vien.tinhTongTienThuong',['thuongNhanVien'=>$thuongNhanVien])}}')" class="btn btn-info btn-md mb-0" type="button" id="button-tong-thuong">
                                            <span class='material-icons'>calculate</span>
                                        </button>
                                    </div>                                    
                                </div>                              
                            </div>                                                     
                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-7">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Danh sách thưởng nhân viên theo các hạng mục</h6>
                            </div>
                            <div class="col-6 text-end">
                                {{-- <a href={{route('hang-muc.nhan-vien.create',['hangMuc'=>$hangMuc])}} class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm nhân viên vào hạng mục</a>                               --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="table-responsive">
                                @include('front.thuong.thuonghangmuc._list',[

                                ])
                            </div>                                               
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4" >           
            <div class="col-12  mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Danh sách kết quả tính thưởng của nhân viên</h6>
                            </div>
                            <div class="col-6 text-end">
                              
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                                @include('front.thuong.ketquatinh._list',[

                                ])
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
        
    @endpush
    @push('scripts')
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>

    <script type="text/javascript" async>

        let tableNhanVien;
        $(function() {
            let customOLanguage = {
                    sSearch: "Tra cứu:",
                    sProcessing: "Đang tải dữ liệu",
                    oPaginate:{
                        sNext: ">",
                        sPrevious:"<"
                    },
                    sEmptyTable:"Chưa có nhân viên thuộc hạng mục này",
                    sInfo:"Hiển thị từ _START_ to _END_ trong tổng số  _TOTAL_",
                    sInfoEmpty:"Không tìm thấy kết quả nào",
                    sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                    sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                    sLengthMenu:"Hiển thị _MENU_ kết quả"
                };

            const customFilter = (table) => {
                table.columns().eq(0).each(function(colIdx) {
                $('input', table.column(colIdx).header()).on('keydown', function(ev) {
                    if (ev.keyCode == 13) { //only on enter keypress (code 13)
                        table.draw();
                        ev.preventDefault();
                    }
                });              

                $('input', table.column(colIdx).header()).on('click', function(e) {
                    e.stopPropagation();
                });               
            });
            }
            
                //table thuong nhan vien thuoc hang muc
            tableNhanVien = $('#thuong-theo-hang-muc-table').DataTable({            
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{!! route('thuong-nhan-vien.thuong-hang-muc.getData',['thuongNhanVien'=>$thuongNhanVien]) !!}',
                    method:'post',
                    data: function(d){
                        d.hang_muc = $("#sch_nv_hang_muc").val();                     
                        d._token = '{{ csrf_token() }}';
                    }
                },
                oLanguage: customOLanguage,
                columns: [
                    // { data: 'id', name: 'id',searchable:false },
                    { data: 'ten_hang_muc', name: 'ten_hang_muc' },
                    // { data: 'muc_thuong', name: 'muc_thuong' },
                    { data: 'so_tien_thuong', name: 'so_tien_thuong' },
                    // { data: 'mo_ta', name: 'mo_ta' },                   
                    { data: 'actions', name: 'actions', searchable: false, orderable:false, className:"text-center"},
                ]
            });

            customFilter(tableNhanVien);

            //table ket qua tinh thuong nhan vien
            tableKetQua = $('#ket-qua-tinh-thuong-table').DataTable({            
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{!! route('thuong-nhan-vien.ket-qua.getData',['thuongNhanVien'=>$thuongNhanVien]) !!}',
                    method:'post',
                    data: function(d){
                        d.hang_muc = $("#sch_kq_hang_muc").val();
                        d.cong_thuc = $("#sch_kq_tinh").val();                     
                        d._token = '{{ csrf_token() }}';
                    }
                },
                oLanguage: customOLanguage,
                columns: [
                    { data: 'id_cong_thuc', name: 'id_cong_thuc',orderable:false },
                    { data: 'ten_hang_muc', name: 'ten_hang_muc',orderable:false },
                    { data: 'ten_cong_thuc', name: 'ten_cong_thuc',orderable:false },
                    { data: 'la_cong_thuc_chinh', name: 'la_cong_thuc_chinh',orderable:false },                    
                    { data: 'ket_qua_tinh', name: 'ket_qua_tinh' },                    
                    { data: 'actions', name: 'actions', searchable: false, orderable:false,className:"text-center"},
                ]
            });

            customFilter(tableKetQua);
            
        });

        let deleteUrl = '';
        
        function setDeleteHangMucUrl(url) {
            if(confirm('Xóa thông tin hạng mục này?')) {
                deleteUrl = url;
                deleteRow(tableNhanVien);
            } 
            return false;
        }

        function setDeleteKetQuaUrl(url) {
            if(confirm('Xóa thông tin kết quả tính này?')) {
                deleteUrl = url;
                deleteRow(tableKetQua);
            } 
            return false;
        }

        function deleteRow(table) {
            $.ajax({
                url: deleteUrl,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "_method": "DELETE"
                },
                success:function(res) {

                    table.ajax.reload(null,false);
                    deleteUrl = '';
                    
                }
            });
        }



        let tinhThuongUrl = '';
        function setTinhThuongUrl(url) {
                tinhThuongUrl = url;
                tinhThuongNhanVien();
            return false;            
        }

        function tinhThuongNhanVien() {
            $.ajax({
                url: tinhThuongUrl,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",                    
                },
                dataType:'json',
                success:function(res) {                    
                    if(res.status=='success') {
                        tableKetQua.ajax.reload(null,false);
                        tinhThuongUrl = '';
                        $("#ket_qua_info_div").show().html(res.message).attr('class','alert alert-success');
                    } else {
                        $("#ket_qua_info_div").show().html(res.message).attr('class','alert alert-danger text-white');
                    }
                    // console.log('ok');
                    // $("#deleteModal").modal('hide');
                    
                    
                }
            });
        }


        let tinhThuongHangMucUrl = '';
        function setTinhThuongHangMucUrl(url) {
            tinhThuongHangMucUrl = url;
            tinhThuongHangMuc();
            return false;            
        }

        function tinhThuongHangMuc() {
            $.ajax({
                url: tinhThuongHangMucUrl,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",                    
                },
                dataType:'json',
                success:function(res) {                    
                    if(res.status=='success') {
                        tableNhanVien.ajax.reload(null,false);
                        tinhThuongHangMucUrl = '';
                        $("#thuong_hang_muc_info").show().html(res.message).attr('class','alert alert-success');
                    } else {
                        $("#thuong_hang_muc_info").show().html(res.message).attr('class','alert alert-danger text-white');
                    }
                }
            });
        }

        function tinhNganSachThuong(url) {
            $.ajax({
                url: url,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",                    
                },
                dataType:'json',
                success:function(res) {                    
                    if(res.status=='success') {
                        
                        $("#ngan_sach_thuong_value").val(res.message).attr('class','form-control text-success');
                    } else {
                        $("#ngan_sach_thuong_value").val(res.message).attr('class','form-control text-danger');
                    }
                }
            });
        }

        function tinhTongTienThuong(url) {
            $.ajax({
                url: url,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",                    
                },
                dataType:'json',
                success:function(res) {                    
                    if(res.status=='success') {
                        
                        $("#tong_tien_thuong_dat_duoc_value").val(res.message).attr('class','form-control text-success');
                    } else {
                        $("#tong_tien_thuong_dat_duoc_value").val(res.message).attr('class','form-control text-danger');
                    }
                }
            });
        }
        
        $("#delete_info_thuong").click(function(e){
            e.preventDefault;
            $.ajax({
                url: "{{route('thuong-nhan-vien.ajaxDestroy',['thuongNhanVien'=>$thuongNhanVien])}}",
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",                    
                    "_method":"DELETE"
                },
                dataType:'json',
                success:function(res) {   
                    console.log(res.status);                 
                    if(res.status=='success') {
                        location = res.url;
                    } else {
                        $('#general-info').show().html(res.message);
                        console.log(2);  
                    }
                }
            });
        });
        
        </script>
    
    @endpush
</x-dashboard-layout>