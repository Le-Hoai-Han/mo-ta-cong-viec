@if(Session::has('success'))
    <div class="alert alert-success">{{Session::get('success')}}</div>
@endif   
@if(Session::has('status'))
    <div class="alert alert-info">{{Session::get('status')}}</div>
@endif  
<div id="status_delete" class="alert d-none"></div> 
<div class="">
    <table class="table" id="no-xau-table">
        <thead>
            <tr >
                <th style="width:50px;">ID
                    <input type="text" id="" placeholder="" class="form-control" readonly disabled>
                </th>
                @if(!isset($nhanVien))
                    <th>Tên nhân viên      
                        <input type="text" id="sch_nv_ho_ten" placeholder="" class="form-control" >  
                    </th>  
                @endif
                <th>Mã đơn hàng
                    <input type="text" id="sch_ma_don_hang" placeholder="" value="" class="form-control" >
                </th>                                                                        
                <th>Số tiền nợ
                    <input type="text" id="sch_tong_so_tien" placeholder="Dùng =,>,<,..." value="" class="form-control" />
                </th>                                            
                <th>Tiền đã trừ
                    <input type="text" id="sch_tien_da_tru" placeholder="Dùng =,>,<,..." value="" class="form-control" />
                </th>
                <th>Còn lại
                    <input type="text" id="sch_tien_con_lai" placeholder="Dùng =,>,<,..." value="" class="form-control" />
                </th> 
                <th>Ngày bắt đầu
                    <input type="text" placeholder="" value="" class="form-control" id='sch_ngay_bat_dau'/>
                </th> 
                <th>Trạng thái
                    <input type="text" readonly disabled placeholder="" value="" class="form-control" />
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

@push('styles')
    <link rel="stylesheet" href="{{ asset('datatable/datatables.min.css') }} ">
    
@endpush
@push('scripts')
<script src="{{ asset('datatable/datatables.min.js') }}"></script>

<script type="text/javascript" async>

    let table;
    $(function() {
        table = $('#no-xau-table').DataTable({
            processing: true,
            serverSide: true,
            displayLength: 12,
            ajax: {
                url:'{!! route('no-xau.getData') !!}',
                method:'post',
                data: function(d){
                    d.tien_con_lai = $('#sch_tien_con_lai').val();
                    d.tien_da_tru = $('#sch_tien_da_tru').val();
                    d.tong_so_tien = $('#sch_tong_so_tien').val();
                    d.ma_don_hang = $("#sch_ma_don_hang").val();
                    d.ngay_bat_dau = $("#sch_ngay_bat_dau").val();
                    @if(!isset($nhanVien))
                        d.ho_ten = $("#sch_nv_ho_ten").val();
                    @else 
                        d.ho_ten = "{{$nhanVien->ho_ten}}";
                    @endif
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
                sEmptyTable:"Chưa có thông tin nợ xấu nào",
                sInfo:"Hiển thị từ _START_ to _END_ trong tổng số  _TOTAL_",
                sInfoEmpty:"Không tìm thấy kết quả nào",
                sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                sLengthMenu:"Hiển thị _MENU_ kết quả"
            },
            columns: [
                { data: 'id', name: 'id',searchable:false },
                @if(!isset($nhanVien))
                { data: 'ten_nhan_vien', name: 'ten_nhan_vien' },
                @endif
                { data: 'ma_don_hang', name: 'ma_don_hang' },  
                { data: 'tong_so_tien',name: 'tong_so_tien' , className:'text-end'},                    
                { data: 'tien_da_tru', name: 'tien_da_tru' , className:'text-end'},
                { data: 'tien_con_lai', name: 'tien_con_lai' , className:'text-end'},
                { data: 'ngay_bat_dau', name: 'ngay_bat_dau' , className:'text-center',searchable: false, orderable:false},
                { data: 'label_trang_thai', name: 'label_trang_thai' , className:'text-center'},
                // { data: 'tong_tien_thuong_con_lai', name: 'tong_tien_thuong_con_lai' , className:'text-end'},
                // { data: 'tong_no_xau', name: 'tong_no_xau' , className:'text-end'},
                // { data: 'mo_ta', name: 'mo_ta' },                   
                { data: 'actions', name: 'actions', searchable: false, orderable:false, className:'text-center'},
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