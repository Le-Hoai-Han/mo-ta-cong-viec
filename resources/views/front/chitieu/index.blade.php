<?php 
$current = "Danh mục chỉ tiêu";

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">Danh mục</h6>
                                </div>
                                <div class="col-6 text-end">
                                    @if(auth()->user()->hasRole('admin'))
                                    <a href={{route('chi-tieu.sao-chep.create')}} class="btn btn-warning btn-md mb-0"><i class="fas fa-copy" aria-hidden="true"></i> Sao chép chỉ tiêu</a>  
                                    @endif
                                  <!-- <a href={{route('giao-chi-tieu.create')}} class="btn btn-info btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Giao chỉ tiêu</a> -->
                                  @if(auth()->user()->can('add_chitieu'))
                                  <a href={{route('chi-tieu.create')}} class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm mới chỉ tiêu</a>
                                  @endif
                                 
                                </div>
                              </div>
                        </div>
                        <div class="card-body over-flow-y">
                            @if(Session::has('error'))
                                <div class="alert alert-danger">{{Session::get('error')}}</div>
                            @endif
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif   
                            <div class="">
                                <table class="table" id="chi-tieu-table">
                                    <thead>
                                        <tr >
                                            <th>ID</th>
                                            <th>Tên chỉ tiêu</th>
                                            <th>Loại chỉ tiêu</th>
                                            <th>Nhóm áp dụng</th>
                                            <th>Số lượng người dùng</th>
                                            <th>Mục tiêu mặc định</th>
                                            <th>Thứ tự sắp xếp</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                
                                </table>
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

        let table;
        $(function() {
            table = $('#chi-tieu-table').DataTable({
                headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                processing: true,
                serverSide: true,
                ajax: '{!! route('chi-tieu.getData') !!}',
                oLanguage: {
                    sSearch: "Tra cứu:",
                    sProcessing: "Đang tải dữ liệu",
                    oPaginate:{
                        sNext: ">",
                        sPrevious:"<"
                    },
                    sEmptyTable:"Chưa có dữ liệu",
                    sInfo:"Hiển thị từ _START_ to _END_ trong tổng số  _TOTAL_",
                    sInfoEmpty:"Không tìm thấy kết quả nào",
                    sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                    sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                    sLengthMenu:"Hiển thị _MENU_ kết quả"
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'ten_chi_tieu', name: 'ten_chi_tieu' },
                    // { data: 'fullname', name: 'fullname',searchable: false },
                    { data: 'loai_chi_tieu', name: 'loai_chi_tieu' },
                    { data: 'ten_nhom', name: 'ten_nhom' },
                    { data: 'sl_nhan_vien', name: 'sl_nhan_vien' },
                    { data:'muc_tieu_mac_dinh',name:'muc_tieu_mac_dinh'},
                    { data: 'thu_tu_sap_xep', name: 'thu_tu_sap_xep' },
                    // { data: 'parentName', name: 'parentName', searchable: false },
                    // { data: 'countChild', name: 'countChild', searchable: false },
                    { data: 'actions', name: 'actions', searchable: false },
                ]
            });
        });

        let deleteUrl = '';
        function setDeleteUrl(url) {

            if(confirm('Xóa chỉ tiêu này?')) {
                deleteUrl = url;
                deleteRow();
            } 
            return false;
            
            // $("#deleteModal").modal('show');
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
                    // $("#deleteModal").modal('hide');
                    table.ajax.reload(null,false);
                    deleteUrl = '';
                    
                }
            });
        }
        
        </script>
    
    @endpush
</x-dashboard-layout>
