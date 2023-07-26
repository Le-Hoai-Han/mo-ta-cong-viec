<?php 
$current = "Thưởng mở mới";

?>
<x-dashboard-layout :current="$current">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Thưởng mở mới</h6>
                          </div>
                        
                        <div class="col-6 text-end">
                            <x-base-link :route="route('thuong-mo-moi-kh-dh.index')" colorClass="warning" label="Danh sách khách hàng - đơn hàng" icon="list"/>
                            @if(auth()->user()->can('add_users'))
                            <x-base-link :route="route('thuong-mo-moi.__capNhatTatCa')" colorClass="warning" label="Cập nhật tất cả thưởng mở mới" icon="report"/>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body over-flow-y" >
                    @if ($errors->any())
                        <div class="alert alert-danger" style="width: fit-content">
                                @foreach ($errors->all() as $error)
                                    <span style="color:white">{{ $error }}</span>
                                @endforeach
                        </div><br>
                    @endif          
                    @if(Session::has('error'))
                    <div style="color:white;width: fit-content" class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-success" style="width: fit-content">{{Session::get('success')}}</div>
                    @endif 

                        <table class="table table-bordered " id="thuong-mo-moi-table">
                            <thead>
                                <tr>
                                    <th>Id <br><br></th>
                                    <th>Nhân viên <input name="nhan_vien" value="{{$thuongMoMoi->ten_nhan_vien}}" class="form-control" id="search_nhan_vien"/></th>
                                     <th>Tháng <input name="thang" value="{{($thuongMoMoi->thang != '' ? $thuongMoMoi->thang :date('m'))}}" class="form-control" id="search_thang"/></th>
                                     <th>Năm <input name="nam" value="{{($thuongMoMoi->nam != '' ? $thuongMoMoi->nam :date('Y'))}}" class="form-control" id="search_nam"/></th>
                                     <th>Số tiền thưởng <input name="so_tien_thuong_mo_moi" value="" disabled class="form-control" id="search_so_tien_thuong_mo_moi"/></th>
                                     <th>Hành động <input name="so_tien_thuong_mo_moi" value="" disabled class="form-control" id=""/></th>

                                </tr>
                            </thead>
                        </table>

                        @push('styles')
                            <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
                        @endpush
                        @push('scripts')
                            <script src="{{ asset('datatable/datatables.min.js') }}"></script>
                            <script>
                                let table;
                            $(function() {
                                $('#thuong-mo-moi-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax:{
                                        url:'{!!url('thuong-mo-moi-anydata') !!}',
                                        method:'post',
                                        data:function(d){
                                            d.ten_nhan_vien = $("#search_nhan_vien").val();
                                            d.thang = $("#search_thang").val();
                                            d.nam = $("#search_nam").val();
                                            d._token = '{{ csrf_token() }}';
                                        }
                                    } ,

                                    oLanguage:{
                                        sSearch:"Tìm kiếm:",
                                        sshow:"Hiển thị", 
                                        sProcessing: "Đang tải dữ liệu",
                                        sZeroRecords: "Không tìm thấy kết quả",
                                        oPaginate:{
                                                    sNext: ">",
                                                    sPrevious:"<"
                                                },
                                        sEmptyTable:"Chưa có dữ liệu",
                                        sInfo:"Hiển thị từ _START_ đến _END_ trong tổng số  _TOTAL_ sản phẩm",
                                        sInfoEmpty:"Không tìm thấy kết quả nào",
                                        sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                                        sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                                        sLengthMenu:"Hiển thị _MENU_ kết quả"
                                    },
                                    columns: [
                                        { data: 'id', name: 'id', className:'text-center' },
                                        { data: 'ten_nhan_vien', name: 'ten_nhan_vien', },
                                        { data: 'thang', name: 'thang', },
                                        { data: 'nam', name: 'nam', },
                                        { data: 'so_tien_thuong_mo_moi', name: 'so_tien_thuong_mo_moi' },
                                        { data: 'actions', name: 'actions', orderable: false, searchable: false},
                                        
                                    ],
                                });
                                // table.columns().eq(0).each(function(colIdx) {
                                // $('input', table.column(colIdx).header()).on('keydown', function(ev) {
                                //     if (ev.keyCode == 13) { //only on enter keypress (code 13)
                                //         table.draw();
                                //         ev.preventDefault();
                                //     }
                                // });
                            

                                // $('input', table.column(colIdx).header()).on('click', function(e) {
                                //     e.stopPropagation();
                                // });

                                // $('select', table.column(colIdx).header()).on('click', function(ev) {
                                //     e.stopPropagation();
                                // });
                                // $('select', table.column(colIdx).header()).on('change', function(ev) {
                                //     if (ev.keyCode == 13) { //only on enter keypress (code 13)
                                //         table.draw();
                                //         ev.preventDefault();
                                //     }
                                // });

                
              
            // });
                            });
                            
                            </script>
                        @endpush
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>