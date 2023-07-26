@extends('run.master')

@section('content')
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Mô tả</th>
                <th>Tỉ lệ thưởng</th>
                <th>Đã cập nhật</th>
                <th>Ngày tạo </th>
                <th>Cập nhật</th>
                <th>Hành động</th>
            </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('danhmucSP.data') !!}',
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
            { data: 'mo_ta', name: 'mo_ta' },
            { data: 'ti_le_thuong', name: 'ti_le_thuong' },
            { data: 'da_cap_nhat', name: 'da_cap_nhat' },
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' },
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ]
    });
});
</script>
@endpush