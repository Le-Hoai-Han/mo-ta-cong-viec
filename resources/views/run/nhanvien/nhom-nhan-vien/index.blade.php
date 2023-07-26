<?php $current = "Danh sách nhân viên "; ?>

<x-dashboard-layout :current="$current">
<x-slot name="title">Danh sách nhân viên</x-slot>

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
                                <h6 class="mb-0">Danh sách nhóm nhân viên</h6>
                            </div>
                            <div class="col-6 d-flex align-items-right text-end" style="justify-content: end;">
                                <a class="mb-0 btn btn-success" href="{{route('nhomnhanvien.create')}}">Thêm nhóm nhân viên</a>
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

                        @if(Session::has('success'))
                        <div style="color:white" class="alert alert-success">{{Session::get('success')}}</div>
                        @endif


                        <div class="row">
                            <table class="table  table-sm" id="employee-group-table">
                                <thead>
                                    <tr >
                                        <th style="text-align: center">Id</th>
                                        <th>Mã nhóm</th>
                                        <th>Tên Nhóm</th>
                                        <th>Người quản lý</th>
                                        <th>Hành động</th>  
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
        <script src="{{ asset('datatable/datatables.min.js') }}"></script>

    <script>
        let table;
        $(function() {
            table = $('#employee-group-table').DataTable({
                headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                processing: true,
                serverSide: true,
                ajax: '{!! route('getNhomNhanVienData') !!}',
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
                    { data: 'ma_nhom', name: 'ma_nhom' },
                    { data: 'ten_nhom', name: 'ten_nhom' },
                    { data: 'id_quan_ly', name: 'id_quan_ly' },
                    // { data: 'parentName', name: 'parentName', searchable: false },
                    // { data: 'countChild', name: 'countChild', searchable: false },
                    { data: 'actions', name: 'actions', searchable: false, className:'text-center' },
                ]
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
        
        </script>
    
    @endpush

</x-dashboard-layout>