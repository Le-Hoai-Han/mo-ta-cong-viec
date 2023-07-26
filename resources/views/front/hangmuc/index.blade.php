<?php 
$current = "Hạng mục thưởng";

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">Danh sách hạng mục</h6>
                                </div>
                                <div class="col-6 text-end">
                                  <a href={{route('hang-muc.create')}} class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm mới</a>                              
                                </div>
                              </div>
                        </div>
                        <div class="card-body over-flow-y">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif   
                            <div class="">
                                <table class="table" id="hang-muc-table">
                                    <thead>
                                        <tr >
                                            <th>ID</th>
                                            <th>Tên hạng mục</th>
                                            <th>Mô tả</th>     
                                            <th>Nhóm áp dụng</th>                                    
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
        <style>
            /* .table.dataTable.no-footer{
                border-bottom:unset;
            } */
        </style>
    @endpush
    @push('scripts')
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>

    <script type="text/javascript" async>

        let table;
        $(function() {
            table = $('#hang-muc-table').DataTable({
                headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                processing: true,
                serverSide: true,
                ajax: '{!! route('hang-muc.getData') !!}',
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
                    { data: 'ten_hang_muc', name: 'ten_hang_muc' },
                    { data: 'mo_ta', name: 'mo_ta' },    
                    { data: 'ten_nhom', name: 'ten_nhom' },                  
                    { data: 'actions', name: 'actions', searchable: false },
                ]
            });

            
        });

        let deleteUrl = '';
        function setDeleteUrl(url) {

            if(confirm('Xóa hạng mục này?')) {
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
