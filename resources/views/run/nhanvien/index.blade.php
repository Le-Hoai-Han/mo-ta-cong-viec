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

                            <div class="col-12 col-md-7 d-flex align-items-center">
                                <h6 class="mb-0">Danh sách nhân viên</h6>
                            </div>
                            <div class="col-12 col-md-5 text-end">
                                <?php $themRoute = route('nhanvien.create')?>
                                <x-link-them-moi :route="$themRoute" label="Thêm mới"/>
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
                            <div class="table-reponsive col-xs-12">
                                <table class="table table-borderless col-xs-12" id="employee-table">
                                    <thead>
                                        <tr >
                                            <th style="text-align: center">Id</th>
                                            <th>Họ tên
                                                <input type="text" name="ho_ten" value="{{$nhanVien->ho_ten}}" class="form-control" id="sch__ho_ten" />
                                            </th>
                                            <th>Email
                                                <input type="text" name="email" value="{{$nhanVien->email}}" class="form-control" id="sch__email" />
                                            </th>
                                            <th>Group<br>
                                                <input type="text" name="group" value="" class="form-control" id="sch__group" />
                                            </th>  
                                            <th>Trạng thái<br>
                                            <select name="da_xoa" id="sch__trang_thai_xoa" class="form-select">

                                                @foreach($nhanVien->dsTrangThaiXoa as $value=>$trangThai)
                                                    <option value={{$value}} {{($nhanVien->da_xoa==$value)?"selected":""}}>{{$trangThai}}</option>
                                                @endforeach
                                            </select>

                                            </th>
                                            <th>Hành động</th>  
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
            table = $('#employee-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{!! route('nhanVien.getData') !!}',
                    method:'post',
                    data: function(d){
                        d.da_xoa = $("#sch__trang_thai_xoa").val();
                        d.email = $("#sch__email").val();
                        d.ho_ten = $("#sch__ho_ten").val();
                        d.group = $("#sch__group").val();
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
                    sEmptyTable:"Chưa có dữ liệu",
                    sInfo:"Hiển thị từ _START_ to _END_ trong tổng số  _TOTAL_",
                    sInfoEmpty:"Không tìm thấy kết quả nào",
                    sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                    sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                    sLengthMenu:"Hiển thị _MENU_ kết quả"
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'ho_ten', name: 'ho_ten' },
                    { data: 'user.email', name: 'user.email' },
                    { data: 'team', name: 'team'},
                    { data: 'da_xoa', name: 'da_xoa'},
                    // { data: 'parentName', name: 'parentName', searchable: false },
                    // { data: 'countChild', name: 'countChild', searchable: false },
                    { data: 'actions', name: 'actions', searchable: false, className:'text-center' },
                ]
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

                $('select', table.column(colIdx).header()).on('click', function(ev) {
                    e.stopPropagation();
                });
                $('select', table.column(colIdx).header()).on('change', function(ev) {
                    if (ev.keyCode == 13) { //only on enter keypress (code 13)
                        table.draw();
                        ev.preventDefault();
                    }
                });

                
              
            });
        });


        let deleteUrl = '';
        function setDeleteUrl(url) {

            if(confirm('Xóa nhân viên này?')) {
                deleteUrl = url;
                deleteRow();
            } 
            return false;
            
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
                dataType:'json',
                success:function(res) {                    
                    if(res.status=='success') {
                        table.ajax.reload(null,false);
                        deleteUrl = '';
                        $("#status_delete").show().html(res.message).attr('class','alert alert-info');
                    } else {
                        $("#status_delete").show().html(res.message).attr('class','alert alert-danger text-white');
                    }
                    // console.log('ok');
                    // $("#deleteModal").modal('hide');
                    
                    
                }
            });
        }
        </script>
    
    @endpush

</x-dashboard-layout>