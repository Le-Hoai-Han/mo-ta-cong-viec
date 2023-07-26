<?php 
$current = "Thưởng mở mới khách hàng - đơn hàng";

?>
<x-dashboard-layout :current="$current">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Thưởng mở mới khách hàng - đơn hàng</h6>
                          </div>
                        
                        <div class="col-6 text-end">
                            @if(auth()->user()->can('add_users'))
                            <x-base-link :route="route('thuong-mo-moi.index')" colorClass="success" label="Thưởng mở mới" icon=""/>
                            <x-link-them-moi :route="route('thuong-mo-moi-kh-dh.create')" label="Thêm"/>
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

                        <table class="table table-bordered " id="thuong-mo-moi-kh-dh-table">
                            <thead>
                                <tr>
                                    <th>Id <br><br></th>
                                    <th>Mã khách hàng <input name="ma_khach_hang" value="{{$TMMDonHangKhachHang->id_khach_hang}}" class="form-control" id="search_ma_khach_hang"/></th>
                                    <th>Đơn hàng đầu tiên <input name="ma_don_hang" value="{{$TMMDonHangKhachHang->id_don_hang_dau_tien}}" class="form-control" id="search_ma_don_hang"/></th>
                                    <th>Thời hạn bắt đầu thưởng <input name="" value="" class="form-control" id="" disabled/></th>
                                    <th>Thời hạn kết thúc thưởng <input name="" value="" class="form-control" id="" disabled/></th>
                                    <th>Trạng thái <input name="" value="" class="form-control" id="" disabled/></th>
                                    <th>Hành động <input name="" value="" class="form-control" id="" disabled/></th>
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
                                $('#thuong-mo-moi-kh-dh-table').DataTable({
                                    processing: true,
                                    serverSide: true,
                                    ajax:{
                                        url:'{!!url('thuong-mo-moi-kh-dh-anydata') !!}',
                                        method:'post',
                                        data:function(d){
                                            d.ma_khach_hang = $("#search_ma_khach_hang").val();
                                            d.ma_don_hang = $("#search_ma_don_hang").val();
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
                                        { data: 'id', name: 'id', className:'text-center align-middle' },
                                        { data: 'ma_khach_hang', name: 'ma_khach_hang',className:'align-middle' },
                                        { data: 'ma_don_hang', name: 'ma_don_hang',className:'align-middle' },
                                        { data: 'ngay_bat_dau', name: 'ngay_bat_dau',className:'align-middle' },
                                        { data: 'ngay_ket_thuc', name: 'ngay_ket_thuc',className:'align-middle' },
                                        { data: 'trang_thai', name: 'trang_thai',className:'align-middle'  },
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