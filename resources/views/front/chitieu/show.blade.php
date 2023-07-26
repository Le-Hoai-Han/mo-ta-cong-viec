<?php 
$current = $chiTieu->ten_hang_muc;
$list = [    
    url('/chi-tieu')=>'Danh sách chỉ tiêu'    
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row" >           
            @include('front.chitieu._info',[
                'chiTieu'=>$chiTieu
            ])
        </div>

        <div class="row mt-4" >           
            <div class="card col-12 mb-4">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-6 d-flex align-items-center">
                            <h6 class="mb-0">Danh sách  viên thuộc chỉ tiêu</h6>
                        </div>
                        <div class="col-6 text-end">
                            <a href={{route('chi-tieu.nhan-vien.create',['chiTieu'=>$chiTieu])}} class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm nhân viên vào chỉ tiêu</a>                              
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    <div class="row">
                        <div class="">
                            <table class="table-responsive" id="nhan-vien-table">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled style="width:50px;">
                                        </th>
                                        <th class="text-center">Tên nhân viên      
                                            <input type="text" id="sch_nv_ho_ten" placeholder="" class="form-control" >  
                                        </th>                                                                            
                                        <th class="text-center">Tháng áp dụng
                                            <input type="text" id="sch_nv_thang_ap_dung" placeholder="" value="{{date('m')}}" class="form-control" >
                                        </th>
                                        <th class="text-center">Mục tiêu
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                        </th>
                                        <th class="text-center">Kết quả
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                        </th>
                                        <th class="text-center">Tỉ lệ(%)
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled style="width:150px;">
                                        </th> 
                                        <th class="text-center">Hành động
                                            <input type="text" id="" placeholder="" class="form-control" readonly disabled style="width:100px;">
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
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
        {{-- <style>
            table.table-bordered.dataTable thead tr th, table.table-bordered.dataTable thead tr td,
            table.table-bordered.dataTable tbody tr th, table.table-bordered.dataTable tbody tr td{
                border-color:#ccc;
            }
        </style> --}}
    @endpush
    @push('scripts')
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>

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
                    url:'{!! route('chi-tieu.nhan-vien.getData',['chiTieu'=>$chiTieu]) !!}',
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
                    // { data: 'muc_tieu', name: 'muc_tieu',className: 'text-end'  },
                    { data: 'muc_tieu', name: 'muc_tieu',className: 'text-end pe-4' },
                    { data: 'ket_qua_dat_duoc', name: 'ket_qua_dat_duoc',className: 'text-end pe-4' },
                    { data: 'ti_le_dat_duoc', name: 'ti_le_dat_duoc',className: 'text-end pe-4' },
                    // { data: 'mo_ta', name: 'mo_ta' },                   
                    { data: 'actions', name: 'actions', searchable: false, orderable:false,className: 'text-center' },
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

        function capNhatKetQua(id){
            input=  $('#inputKetQua-'+id);
            valueInputKQ =$('#inputKetQua-'+id).val();
            valueInputTL =$('#inputTiLe-'+id);
        
            input.on('keypress',function(e){
                if(e.which == 13){
                    input.css('background','green');
                    input.css('color','white')
                    $.ajax({
                        url:"{{route('chi-tieu.nhan-vien.update-chi-tieu')}}",
                        type:"POST",
                        data:{
                            "_token":"{{ csrf_token() }}",
                            "id":id,
                            "valueInput":valueInputKQ
                            
                        },
                        success:function(res){
                            // console.log(res);
                            valueInputTL.html(res);
                        }
                    })
                        }
            })
            
        }
        
        </script>
    
    @endpush
</x-dashboard-layout>