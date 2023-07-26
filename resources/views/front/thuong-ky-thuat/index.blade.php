<?php 
$current = "Danh sách tiền thưởng nhân viên kỹ thuật";

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">{{$current}}</h6>
                                </div>
                                <div class="col-6 text-end">
                                    <x-base-link :route="route('thuong-thoi-gian.index')" colorClass="info" label="Danh sách thưởng quý" icon="list"/>
                                    <x-base-link :route="route('thuong-nam.index')" colorClass="warning" label="Danh sách thưởng năm" icon="list"/>
                                    @if(auth()->user()->can('add_thuongkythuats'))

                                        <x-link-them-moi :route="route('thuong-nhan-vien.create')" label="Thêm thông tin"/>                                                           
                                                                  
                                    @endif
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
                                <table class="table" id="thuong-nhan-vien-table">
                                    <thead>
                                        <tr >
                                            <th>ID
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>
                                            <th>Tên nhân viên      
                                                <input type="text" id="sch_nv_ho_ten" placeholder="" value="{{$thuongThoiGian->ho_ten}}"class="form-control" >  
                                            </th>                                                                            
                                            <th>Tháng áp dụng
                                                <input type="text" id="sch_nv_thang_ap_dung" placeholder="" value="{{implode(',',$thuongThoiGian->getDsThangThuocQuyDangTinh())}}" class="form-control" >
                                            </th>
                                            <th>Năm áp dụng
                                                <input type="text" id="sch_nv_nam_ap_dung" placeholder="" value="{{$thuongThoiGian->nam}}" class="form-control" >
                                            </th>
                                            <th>Ngân sách thưởng
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>
                                            <th>Thực lãnh
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th> 
                                            <th>Trạng thái
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>                                            
                                            <th>Hành động
                                                <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <td></td>
                                            <td colspan="3" style="text-align:right">Total:</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                
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
            table = $('#thuong-nhan-vien-table').DataTable({
                processing: true,
                serverSide: true,
                displayLength: 12,
                ajax: {
                    url:'{!! route('thuong-ky-thuat.getData') !!}',
                    method:'post',
                    data: function(d){
                        d.thang = $("#sch_nv_thang_ap_dung").val();
                        d.nam = $("#sch_nv_nam_ap_dung").val();
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
                    { data: 'nam_ap_dung', name: 'nam_ap_dung' },                    
                    { data: 'ngan_sach_thuong', name: 'ngan_sach_thuong' , className:'text-end'},
                    { data: 'tong_tien_thuong_dat_duoc', name: 'tong_tien_thuong_dat_duoc', className:'text-end' },
                    { data: 'da_nhan_thuong', name: 'da_nhan_thuong', className:'text-center' },
                    // { data: 'mo_ta', name: 'mo_ta' },                   
                    { data: 'actions', name: 'actions', searchable: false, orderable:false, className:'text-center'},
                ],
                footerCallback: function (row, data, start, end, display) {
                    var api = this.api();
        
                    // Remove the formatting to get integer data for summation
                    var intVal = function (i) {
                        return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                    };
        
                    // Total over this page
                    nganSachThuongTotal = api
                        .column(4, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);

                        thucLanhTotal = api
                        .column(5, { page: 'current' })
                        .data()
                        .reduce(function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0);
        
                    // Update footer
                    $(api.column(4).footer()).html(new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(nganSachThuongTotal) );
                    $(api.column(5).footer()).html(new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(thucLanhTotal));
                },
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
