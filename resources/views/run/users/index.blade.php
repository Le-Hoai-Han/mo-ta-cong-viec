<x-dashboard-layout>

<x-slot name="title">Danh sách người dùng</x-slot>


    <?php 
    $list = [
            '/'=>'Trang chủ',
            '#'=>'Danh sách người dùng'
        ];
    ?>

<div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Danh sách users</h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body over-flow-y">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach

                            </div><br>
                        @endif          

                        @if(Session::has('error'))
                            <div style="color:white" class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif


                        <div class="row">
                        <table class="table table-striped table-sm" id="users-table">
                            <thead>
                                <tr >
                                    <th style="text-align: center">Ảnh đại diện</th>
                                    {{-- <th>Tên đăng nhập</th> --}}
                                    <th>Họ tên</th>
                                    <th>Email</th>
                                    <th>Quyền</th>
                                    {{-- <th class="px-4 py-2">Updated At</th> --}}
                                    <th></th>
                                </tr>
                            </thead>
                        
                        </table>
                        </div>
                    </div>
                </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('datatable/datatables.min.js') }}"></script>
    <script>
        let table;
        $(function() {
            table = $('#users-table').DataTable({
                headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                processing: true,
                serverSide: true,
                ajax: '{!! route('getUsersData') !!}',
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
                    { data: 'image', name: 'image' },
                    { data: 'name', name: 'name' },
                    // { data: 'fullname', name: 'fullname',searchable: false },
                    { data: 'email', name: 'email' },
                    { data: 'role', name: 'role',searchable: false },
                    // { data: 'parentName', name: 'parentName', searchable: false },
                    // { data: 'countChild', name: 'countChild', searchable: false },
                    { data: 'actions', name: 'actions', searchable: false },
                ]
            });
        });

        let deleteUrl = '';
        function setDeleteUrl(url) {
            deleteUrl = url;
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
        
        </script>
    
    @endpush

</x-dashboard-layout>