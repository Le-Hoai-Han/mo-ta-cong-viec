<?php $current = "Đơn hàng đã thanh toán đủ"; ?>

<x-dashboard-layout :current="$current">
<x-slot name="title">Đơn hàng đã thanh toán đủ</x-slot>

    <?php 
    $list = [
            '/'=>'Trang chủ',
            '#'=>'Đơn hàng đã thanh toán đủ'
        ];
    ?>

<div class="main-div">
        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Đơn hàng đã thanh toán đủ</h6>
                            </div>
                        </div>
                    </div>

                    <div class="card-body over-flow-y">
                   
                        <div id='thong-bao-gui-mail' class="alert" style="display: none">

                        </div>

                        @if(Session::has('error'))
                        <div style="color:white;width: fit-content" class="alert alert-danger">{{Session::get('error')}}</div>
                        @endif
    
                        @if(Session::has('success'))
                            <div class="alert alert-success" style="width: fit-content">{{Session::get('success')}}</div>
                        @endif 
                   

                        <div class="row">
                            <table class="table  table-sm" id="don-hang-da-duyet-table">
                                <thead>
                                    <tr >
                                        <th>Mã đơn hàng <input type="text" name="ma_don_hang" id="search_ma_don_hang" class="form-control" /></th>
                                        <th>Mã khách hàng <input type="text" name="ma_khach_hang" id="search_ma_khach_hang" class="form-control" /> </th>  
                                        <th>Email khách hàng <input type="text" name="email_khach_hang" id="search_email_khach_hang" class="form-control" /></th>  
                                        <th>Trạng thái <input disabled class="form-control" /></th>
                                        <th>Ngày thực hiện <input type="date" name="ngay_thuc_hien" id="search_ngay_thuc_hien" class="form-control" /></th>
                                        <th>Hành động <input disabled class="form-control" /></th>
                                    </tr>
                                </thead>
                            
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>   


    <x-modal-bootstrap id="pushEmailModal" class="alert-danger"> 
        <x-slot name="title">Xác nhận</x-slot>
        <x-slot name="body">Bạn chắc chắn muốn gửi lại?</x-slot>
        <x-slot name="button">
            <button type="button" class="btn btn-danger" onclick="sendEmail()">Đồng ý</button>
        </x-slot>
    </x-modal-bootstrap>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
        <style>
            .px-24{
                padding-left: 24px !important;
                padding-right: 24px !important;
            }
        </style>
    @endpush
    @push('scripts')
        <script src="{{ asset('datatable/datatables.min.js') }}"></script>

    <script>
        let table;
        $(function() {
            table = $('#don-hang-da-duyet-table').DataTable({
                headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}',
                    },
                processing: true,
                serverSide: true,
                ajax:{
                    url:'{!! route('don-hang-da-thanh-toan-du.anyData') !!}',
                    method:'post',
                    data:function(d){
                    d.ma_don_hang=$("#search_ma_don_hang").val();
                    d.ma_khach_hang=$("#search_ma_khach_hang").val();
                    d.email_khach_hang=$("#search_email_khach_hang").val();
                    d.ngay_thuc_hien=$("#search_ngay_thuc_hien").val();
                    d._token ='{{ csrf_token() }}';
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
                    { data: 'ma_don_hang', name: 'ma_don_hang',className:'px-24' },
                    { data: 'ma_khach_hang', name: 'ma_khach_hang' ,className:'px-24'},
                    { data: 'email_nguoi_lien_he', name: 'email_nguoi_lien_he',className:'px-24'},
                    { data: 'trang_thai', name: 'trang_thai', searchable: false,className:'px-24' },
                    { data: 'ngay_thuc_hien', name: 'ngay_thuc_hien',className:'px-24' },
                    // { data: 'countChild', name: 'countChild', searchable: false },
                    { data: 'actions', name: 'actions', searchable: false, className:'text-center' },
                ]
            });
        });

        let pushEmailUrl = '';
        function setPushEmail(url) {
            pushEmailUrl = url;
            $("#pushEmailModal").modal('show');
        }

        function sendEmail() {
            $.ajax({
                url: pushEmailUrl,
                type:'GET',
                dataType:'json',
                data:{
                    "_token": "{{ csrf_token() }}"
                },
                success:function(res) {
                    if(res.status == 'success'){
                        $('#thong-bao-gui-mail').addClass('alert-success').html(res.message).show();
                        $('#thong-bao-gui-mail').removeClass('alert-danger');
                    }else{
                        $('#thong-bao-gui-mail').addClass('alert-danger').html(res.message).show();
                        $('#thong-bao-gui-mail').removeClass('alert-success');
                    }
                    $("#pushEmailModal").modal('hide');
                    table.ajax.reload(null,false);
                    pushEmailUrl = '';
                    
                }
            });
        }
        
        </script>
    
    @endpush

</x-dashboard-layout>