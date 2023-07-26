<?php 
$current = $hangMuc->ten_hang_muc;
$list = [    
    url('/hang-muc')=>'Danh sách hạng mục'    
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >           
            @include('front.hangmuc._info',[
                'hangMuc'=>$hangMuc
            ])
        </div>

        <div class="row mt-4" >           
            <div class="card col-12 col-md-8  mb-lg-0 mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Danh sách thưởng nhân viên thuộc hạng mục</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href={{route('thuong-nhan-vien.create')}} class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm thông tin thưởng nhân viên</a>                              
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    <div class="row">
                        <div class="">
                            <table class="table" id="nhan-vien-table">
                                <thead>
                                    <tr>
                                        <th>ID
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                        </th>
                                        <th>Tên nhân viên      
                                            <input type="text" id="sch_nv_ho_ten" placeholder="" class="form-control" >  
                                        </th>                                                                            
                                        <th>Tháng áp dụng
                                            <input type="text" id="sch_nv_thang_ap_dung" placeholder="" value="{{date('m')}}" class="form-control" >
                                        </th>
                                        <th>Mức thưởng
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                        </th>
                                        <th>Số tiền thưởng
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                        </th> 
                                        <th>Hành động
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                        </th>
                                    </tr>
                                </thead>
                            
                            </table>
                        </div>                                               
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }} ">
        <style>
            /* .table.dataTable.no-footer{
                border-bottom:unset;
            } */
        </style>
    @endpush
    @push('scripts')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>

    <script type="text/javascript" async>

        let tableNhanVien;
        $(function() {
            tableNhanVien = $('#nhan-vien-table').DataTable({
                // headers: {
                //         'X-CSRF-Token': '{{ csrf_token() }}',
                //     },
                processing: true,
                serverSide: true,
                ajax: {
                    url:'{!! route('hang-muc.nhan-vien.getData',['hangMuc'=>$hangMuc]) !!}',
                    method:'post',
                    data: function(d){
                        d.thang = $("#sch_nv_thang_ap_dung").val();
                        d.ho_ten = $("#sch_nv_ho_ten").val();
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
                    sEmptyTable:"Chưa có nhân viên thuộc hạng mục này",
                    sInfo:"Hiển thị từ _START_ to _END_ trong tổng số  _TOTAL_",
                    sInfoEmpty:"Không tìm thấy kết quả nào",
                    sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                    sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                    sLengthMenu:"Hiển thị _MENU_ kết quả"
                },
                columns: [
                    { data: 'id', name: 'id',searchable:false },
                    { data: 'ten_nhan_vien', name: 'ten_nhan_vien' },
                    { data: 'thang_ap_dung', name: 'thang_ap_dung' },                    
                    { data: 'muc_thuong', name: 'muc_thuong' },
                    { data: 'so_tien_thuong', name: 'so_tien_thuong' },
                    // { data: 'mo_ta', name: 'mo_ta' },                   
                    { data: 'actions', name: 'actions', searchable: false, orderable:false},
                ]
            });

            tableNhanVien.columns().eq(0).each(function(colIdx) {
                $('input', tableNhanVien.column(colIdx).header()).on('keydown', function(ev) {
                    if (ev.keyCode == 13) { //only on enter keypress (code 13)
                        tableNhanVien.draw();
                        ev.preventDefault();
                    }
                });
                // $('select', tableNhanVien.column(colIdx).header()).on('change', function(ev) {
                //     //if (ev.keyCode == 13) { //only on enter keypress (code 13)
                //         tableNhanVien
                //             .column(colIdx)
                //             .search(this.value)
                //             .draw();
                //     //}
                // });

                $('input', tableNhanVien.column(colIdx).header()).on('click', function(e) {
                    e.stopPropagation();
                });
                // $('select', tableNhanVien.column(colIdx).header()).on('click', function(e) {
                //     e.stopPropagation();
                // });
            });

            
        });

        let deleteNhanVienUrl = '';
        
        function setDeleteNhanVienUrl(url) {

            if(confirm('Xóa nhân viên khỏi tháng này?')) {
                deleteNhanVienUrl = url;
                deleteRow(tableNhanVien);
            } 
            return false;
            
            // $("#deleteModal").modal('show');
        }

        function deleteRow(table) {
            $.ajax({
                url: deleteNhanVienUrl,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "_method": "DELETE"
                },
                success:function(res) {
                    // console.log('ok');
                    // $("#deleteModal").modal('hide');
                    table.ajax.reload(null,false);
                    deleteNhanVienUrl = '';
                    
                }
            });
        }
        
        </script>
    
    @endpush
</x-dashboard-layout>