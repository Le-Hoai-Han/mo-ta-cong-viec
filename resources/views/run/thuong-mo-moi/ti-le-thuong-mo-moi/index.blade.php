<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-xl-4">Tỉ lệ thưởng mở mới</div>
                        <div class="col-12 col-xl-8 text-end">
                            @if(auth()->user()->can('add_users'))
                            <a href={{route('ti-le-thuong-mo-moi.create')}} class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm</a>
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
                                    <th>Tên loại <input type="text" name="ten_loai" value="" class="form-control" id="search_ten_loai" /></th>
                                    <th>Tỉ lệ thưởng <input disabled type="text" name="" value="" class="form-control" id="" /></th>
                                    <th>Mô tả<br>
                                        <select class="form-control" name="" id="search_trang_thai">
                                            @foreach($tiLeThuong->dsTrangThai as $key => $item)
                                                <option value="{{$key}}">{{$item}}</option> 
                                            @endforeach
                                        </select>
                                    </th>
                                    <th>Ngày <input disabled type="text" name="" value="" class="form-control" id="" /></th>
                                    <th>Hành động <input disabled type="text" name="" value="" class="form-control" id="" /></th>
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
                                        url:'{!!url('ti-le-thuong-mo-moi-anydata') !!}',
                                        method:'post',
                                        data: function(d){
                                            d.mo_ta = $("#search_trang_thai").val();
                                            d.ten_loai = $("#search_ten_loai").val();
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
                                        { data: 'ten_loai', name: 'ten_loai', },
                                        { data: 'ti_le_thuong', name: 'ti_le_thuong' },
                                        { data: 'mo_ta', name: 'mo_ta' },
                                        { data: 'ngay', name: 'ngay' },
                                        {data: 'actions', name: 'actions', orderable: false, searchable: false},
                                        
                                    ],
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
                            
                            </script>
                        @endpush
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layout>