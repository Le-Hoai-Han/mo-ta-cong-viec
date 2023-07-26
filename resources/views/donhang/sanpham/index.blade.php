<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="col-8">Danh mục sản phẩm</div>
                    <div class="col-4 text-end"><a href="{{route('danh-muc-san-pham.create')}}" class="btn btn-success">Thêm sản phẩm</a></div>
                </div>
                <div class="card-body over-flow-y">
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif

                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-bordered" id="danh-muc-san-pham-table"   >
                            <thead  class="align-middle">
                                <tr >
                                    <th rowspan='2'>ID</th>
                                    <th rowspan='2'>Mã <br>sản phẩm</th>
                                    <th rowspan='2' >Tên sản phẩm</th>
                                    <th colspan='5'>Tỉ lệ thưởng</th>
                                    
                                    <th rowspan='2'>Loại <br>sản phẩm</th>
                                    <!-- <th>Đã cập nhật</th> -->
                                    <th rowspan='2'>Dòng sản phẩm</th>
                                    <th rowspan='2'>Cập<br> nhật</th>
                                    <th rowspan='2'>Hành<br> động</th>
                                </tr>
                                <tr>
                                    <th>Máy <br>thanh<br> lý</th>
                                    <th>(PM)</th>
                                    <th>Sale <br>(tự tìm)</th>
                                    <th>sale <br>(nguồn <br>MKT)</th>
                                    <th>Tiền <br>thưởng<br> dịch vụ</th>
                                </tr>
                            </thead>
                            <tbody class="align-middle flex-wrap"></tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div> 

@push('styles')
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
@endpush
@push('scripts')
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>
<script>
$(function() {
    $('#danh-muc-san-pham-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('danh-muc-san-pham.getData') !!}',
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
            { data: 'id', name: 'id' },
            { data: 'ma_san_pham', name: 'ma_san_pham' },
            { data: 'ten_san_pham', name: 'ten_san_pham' }, 
            { data: 'ti_le_thuong_thanh_ly', name: 'ti_le_thuong_thanh_ly' },
            { data: 'ti_le_thuong_bd', name: 'ti_le_thuong_bd' },
            { data: 'ti_le_thuong_sale', name: 'ti_le_thuong_sale' },
            { data: 'ti_le_thuong_sale_nguon_co_san', name: 'ti_le_thuong_sale_nguon_co_san' },
            { data: 'tien_thuong_dich_vu', name: 'tien_thuong_dich_vu' },
            { data: 'id_loai_san_pham', name: 'id_loai_san_pham' },
            { data: 'dong_san_pham', name: 'dong_san_pham' },
            // { data: 'da_cap_nhat', name: 'da_cap_nhat' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false,className:'text-center'}
        ]
    });
});
</script>
@endpush
</x-dashboard-layout>