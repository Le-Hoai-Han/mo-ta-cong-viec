<?php 
$current = "Danh sách tiền thưởng nhân viên theo năm";

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">Danh sách tiền thưởng nhân viên theo năm</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <x-base-link :route="route('thuong-nhan-vien.index')" colorClass="info" label="Danh sách thưởng nhân viên" icon="list"/>
                                    <x-base-link :route="route('thuong-thoi-gian.index')" colorClass="warning" label="Danh sách thưởng quý" icon="list"/>
                                   
                                </div>
                              </div>
                        </div>
                        <div class="card-body over-flow-y">
                            @if(Session::has('success'))
                                <div class="alert alert-success">{{Session::get('success')}}</div>
                            @endif   
                            @if(Session::has('status'))
                                <div class="alert alert-info">{{Session::get('status')}}</div>
                            @endif  
                            <div id="status_delete" class="alert d-none"></div> 
                            <div class="">
                                <table class="table" id="thuong-nam-table">
                                    <thead>
                                        <tr >
                                            <th>ID
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>
                                            <th>Tên nhân viên      
                                                <input type="text" id="sch_nv_ho_ten" placeholder="" class="form-control" >  
                                            </th>                                                                            
                                            <th>Năm
                                                <input type="text" id="sch_nv_nam_ap_dung" placeholder="" value="{{date('Y')}}" class="form-control" >
                                            </th>                                            
                                            <th>Ngân sách thưởng
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>
                                            <th>Đã nhận
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th> 
                                            <!-- <th>Còn lại
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>
                                            <th>Nợ xấu còn lại
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>                                             -->
                                            <th>Hành động
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>
                                        </tr>
                                    </thead>
                                    <!-- <tfoot>
                                        <tr>
                                            <td colspan="4" style="text-align:right">Total:</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot> -->
                                
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
        
    @endpush
    @push('scripts')
    <script src="{{ asset('datatable/datatables.min.js') }}"></script>

    <script type="text/javascript" async>

        let table;
        $(function() {
            table = $('#thuong-nam-table').DataTable({
                processing: true,
                serverSide: true,
                displayLength: 12,
                ajax: {
                    url:'{!! route('thuong-nam.getData') !!}',
                    method:'post',
                    data: function(d){
                        // d.thang = $("#sch_nv_thang_ap_dung").val();
                        // d.nam = $("#sch_nv_nam_ap_dung").val();
                        // d.ho_ten = $("#sch_nv_ho_ten").val();
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
                    { data: 'nam', name: 'nam' },                    
                    { data: 'tong_ngan_sach_thuong', name: 'tong_ngan_sach_thuong' , className:'text-end'},
                    { data: 'tong_tien_thuong_da_nhan', name: 'tong_tien_thuong_da_nhan' , className:'text-end'},
                    // { data: 'tong_tien_thuong_con_lai', name: 'tong_tien_thuong_con_lai' , className:'text-end'},
                    // { data: 'tong_no_xau', name: 'tong_no_xau' , className:'text-end'},
                    // { data: 'mo_ta', name: 'mo_ta' },                   
                    { data: 'actions', name: 'actions', searchable: false, orderable:false, className:'text-center'},
                ],
                
                // footerCallback: function (row, data, start, end, display) {
                //     var api = this.api();
        
                //     // Remove the formatting to get integer data for summation
                //     var intVal = function (i) {
                //         return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                //     };
        
                //     // Total over this page
                //     nganSachThuongTotal = api
                //         .column(3, { page: 'current' })
                //         .data()
                //         .reduce(function (a, b) {
                //             return intVal(a) + intVal(b);
                //         }, 0);

                //         thucLanhTotal = api
                //         .column(4, { page: 'current' })
                //         .data()
                //         .reduce(function (a, b) {
                //             return intVal(a) + intVal(b);
                //         }, 0);
        
                //     // Update footer
                //     $(api.column(3).footer()).html(new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(nganSachThuongTotal) );
                //     $(api.column(4).footer()).html(new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(thucLanhTotal));
                // },
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
              
            });

            
        });

        let deleteUrl = '';
        function setDeleteUrl(url) {

            if(confirm('Xóa hạng mục này?')) {
                deleteUrl = url;
                deleteRow();
            } 
            return false;
            
            // $("#deleteModal").modal('show');
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
