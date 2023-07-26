<?php $current = "Danh mục loại sản phẩm "; ?>

<x-dashboard-layout :current="$current">
<x-slot name="title">Danh mục loại sản phẩm</x-slot>

    <?php 
    $list = [
            '/'=>'Trang chủ',
            '#'=>'Danh mục loại sản phẩm'
        ];
    ?>

<div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Danh mục loại sản phẩm</h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body over-flow-y">
                   
                        @if(Session::has('error'))
                            <div style="color:white" class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif


                        <div class="row">
                            <table class="table  table-sm" id="loai-san-pham-table">
                                <thead>
                                    <tr >
                                        <th style="text-align: center">ID</th>
                                        <th>Mã loại</th>
                                        <th>Tên loại</th>
                                        <th>Cấp độ</th>  
                                        <th>Thuộc danh mục</th>  
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
            table = $('#loai-san-pham-table').DataTable({
                headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                processing: true,
                serverSide: true,
                ajax: '{!! route('loai-san-pham.getData') !!}',
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
                    { data: 'code', name: 'code' },
                    { data: 'name', name: 'name' },
                    { data: 'level', name: 'level'},
                    { data: 'parent_id', name: 'parent_id'},
                    // { data: 'parentName', name: 'parentName', searchable: false },
                    // { data: 'countChild', name: 'countChild', searchable: false },
                    { data: 'actions', name: 'actions', searchable: false, className:'text-center' },
                ]
            });
        });

        // let deleteUrl = '';
        // function setDeleteUrl(url) {
        //     deleteUrl = url;
        //     $("#deleteModal").modal('show');
        // }

        // function deleteRow() {
        //     $.ajax({
        //         url: deleteUrl,
        //         type:'POST',
        //         data:{
        //             "_token": "{{ csrf_token() }}",
        //             "_method": "DELETE"
        //         },
        //         success:function(res) {
        //             // console.log('ok');
        //             $("#deleteModal").modal('hide');
        //             table.ajax.reload(null,false);
        //             deleteUrl = '';
                    
        //         }
        //     });
        // }
        
        </script>
    
    @endpush

</x-dashboard-layout>