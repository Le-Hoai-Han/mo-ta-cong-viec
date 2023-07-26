<?php 
$current = "Danh sách thông tin thưởng quản lý sản phẩm";
?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
            <div class="col-xs-12">
            <x-simple-card buttonCol="7" labelCol="5" extClass="mt-3" headerClass="bg-dark text-white "> 
                <x-slot name="title">
                    <h6 class="text-white">
                        Danh sách nhân viên được thưởng
                    </h6>
                </x-slot>
                <x-slot name="button">
                   
                    @if(auth()->user()->can('add_quanlysanphams'))

                        <a href='#' class='btn btn-warning' onclick='khoiTaoThongTinThuong()'>Khởi tạo thông tin</a>                                                          
                                                    
                    @endif
                </x-slot>
                @if(Session::has('success'))
                    <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif   
                @if(Session::has('status'))
                    <div class="alert alert-info">{{Session::get('status')}}</div>
                @endif  
                <div id="status_delete" class="alert d-none"></div> 
                <div class="">
                    <table class="table" id="thuong-nhan-vien-table">
                        <thead>
                            <tr >
                                <th>ID
                                    <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                </th>
                                <th>Tên nhân viên      
                                    <input type="text" id="sch_nv_ho_ten" placeholder="" class="form-control" >  
                                </th>                                                                            
                                <th>Tháng áp dụng
                                    <input type="text" id="sch_nv_thang_ap_dung" placeholder="" value="{{$thuongSanPhamQuanLy->thang}}" class="form-control" >
                                </th>
                                <th>Năm áp dụng
                                    <input type="text" id="sch_nv_nam_ap_dung" placeholder="" value="{{$thuongSanPhamQuanLy->nam}}" class="form-control" >
                                </th>
                                <th>Số tiền thưởng
                                    <input type="text" id="sch_so_tien_thuong" placeholder="" class="form-control" >
                                </th>
                                
                                <th>Trạng thái
                                    <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                </th>                                            
                                <th>Hành động
                                    <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                </th>
                            </tr>
                        </thead>
                        
                    
                    </table>
                </div>
            </x-simple-card>

            </div>
        </div>
    </div>

<x-modal-bootstrap id="deleteModal" class="alert-danger"> 
    <x-slot name="title">Xác nhận</x-slot>
    <x-slot name="body">Nội dung bị xóa sẽ không thể khôi phục. Xác nhận xóa?</x-slot>
    <x-slot name="button">
        <button type="button" class="btn btn-danger" onclick="deleteRow()">Tôi muốn xóa.</button>
    </x-slot>
</x-modal-bootstrap>
@push('styles')
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
@endpush
@push('scripts')
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>

<script>
    let table;
    $(function() {
            table = $('#thuong-nhan-vien-table').DataTable({
                processing: true,
                serverSide: true,
                displayLength: 12,
                ajax: {
                    url:'{!! route('thuong-quan-ly.san-pham.getData') !!}',
                    method:'post',
                    data: function(d){
                        d.thang = $("#sch_nv_thang_ap_dung").val();
                        d.nam = $("#sch_nv_nam_ap_dung").val();
                        d.so_tien_thuong = $("#sch_so_tien_thuong").val();
                        d.ho_ten = $("#sch_nv_ho_ten").val();
                        d._token = '{{ csrf_token() }}';
                    }
                },
                oLanguage: {
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
                },
                columns: [
                    { data: 'id', name: 'id',searchable:false },
                    { data: 'ten_nhan_vien', name: 'ten_nhan_vien' },
                    { data: 'thang', name: 'thang' },                    
                    { data: 'nam', name: 'nam' },                    
                    { data: 'so_tien_thuong', name: 'so_tien_thuong' , className:'text-end'},
                    { data: 'label_trang_thai', name: 'label_trang_thai', className:'text-center' },
                    // { data: 'mo_ta', name: 'mo_ta' },                   
                    { data: 'actions', name: 'actions', searchable: false, orderable:false, className:'text-center'},
                ],
               
            });

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

            
        });

    let deleteUrl = '';
    function setDeleteUrl(url) {
        deleteUrl = url;
        console.log(url);
        $("#deleteModal").modal('show');
    }

    
    function deleteRow() {
        $.ajax({
            url: deleteUrl,
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                "_method": "DELETE"
            },
            success:function(res) {
                // console.log('ok');
                $("#deleteModal").modal('hide');
                table.ajax.reload(null,false);
                deleteUrl = '';
                
            }
        });
    }

    //cap nhat thong tin thuong quan ly san pham
    function updateRecord(url) {
        $.ajax({
            url: url,
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
            },
            success:function(res) {                
                table.ajax.reload(null,false);                
            }
        });
    }

    function khoiTaoThongTinThuong() {
        let thang = $("#sch_nv_thang_ap_dung").val();
        let nam = $("#sch_nv_nam_ap_dung").val();

        thang = (thang!='')?thang:{{ date('m') }};
        nam = (nam!='')?nam:{{ date('Y') }};

        $.ajax({
            url: "{{url('/thuong-quan-ly/san-pham/khoi-tao')}}/"+thang+'/'+nam,
            type:'POST',
            data:{
                "_token": "{{ csrf_token() }}",
            },
            success:function(res) {                
                table.ajax.reload(null,false);                
            }
        });
    }
    </script>

@endpush
</x-dashboard-layout>
