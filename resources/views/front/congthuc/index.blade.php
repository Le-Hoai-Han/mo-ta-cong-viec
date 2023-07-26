<?php 
$current = "Danh sách công thức tính";

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">Danh sách công thức</h6>
                                </div>
                                <div class="col-6 text-end">
                                  <a href={{route('cong-thuc.create')}} class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm mới</a>
                                  {{-- <button class="btn btn-outline-primary btn-sm mb-0">Thêm mới</button>
                                  <button class="btn btn-outline-primary btn-sm mb-0">Thêm mới</button>
                                  <button class="btn btn-outline-primary btn-sm mb-0">Thêm mới</button> --}}
                                </div>
                              </div>
                        </div>
                        <div class="card-body over-flow-y">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif   
                            <div class="table-responsive">
                                <table class="table" id="cong-thuc-table">
                                    <thead>
                                        <tr >
                                            <th>ID</th>
                                            <th>Tên công thức</th>
                                            <th>Mô tả</th>
                                            <th>Nội dung</th>
                                            
                                            <th>Công thức cha </th>
                                            <th>Loại</th>
                                            <th>Nhóm áp dụng</th>
                                            <th>Trạng thái</th>
                                            
                                            {{-- <th>Số chỉ tiêu trong công thức</th>
                                            <th>Số biến số trong công thức</th> --}}
                                            <th >Hành động</th>
                                        </tr>
                                    </thead>
                                
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <x-info-cong-thuc-modal />
    @push('styles')
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
        <style>
            .noi-dung-cong-thuc-col{
                white-space: break-spaces !important;
            }
        </style>
    @endpush
    @push('scripts')
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>


    <script type="text/javascript" async>

        let table;
        $(function() {
            table = $('#cong-thuc-table').DataTable({
                headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                processing: true,
                serverSide: true,
                ajax: '{!! route('cong-thuc.getData') !!}',
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
                    { data: 'ten_cong_thuc', name: 'ten_cong_thuc' },
                    { data: 'mo_ta', name: 'mo_ta' },
                    { data: 'noi_dung', name: 'noi_dung',className:'noi-dung-cong-thuc-col' },                    
                    { data: 'id_cong_thuc_cha', name: 'id_cong_thuc_cha',className:"text-center"  },
                    { data: 'loai', name: 'loai',className:"text-center"},
                    { data: 'ten_nhom', name: 'ten_nhom',className:"text-left"  },
                    { data: 'dang_su_dung', name: 'dang_su_dung',className:"text-center"  },
                    
                    // { data: 'mo_ta', name: 'mo_ta' },

                    // { data: 'sl_cong_thuc', name: 'sl_cong_thuc' },
                    // { data: 'parentName', name: 'parentName', searchable: false },
                    // { data: 'countChild', name: 'countChild', searchable: false },
                    { data: 'actions', name: 'actions', searchable: false },
                ]
            });
        });

        let deleteUrl = '';
        function setDeleteUrl(url) {

            if(confirm('Xóa biến này?')) {
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
