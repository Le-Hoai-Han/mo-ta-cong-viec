<?php 
$current = "Danh mục số tiền quy ước thưởng cho khối kỹ thuật";
?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
            <div class="col-xs-12">
                <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">Danh mục số tiền quy ước thưởng cho khối kỹ thuật</h6>
                                </div>
                                <div class="col-6 text-end">
                                    
                                    @if(auth()->user()->can('add_sotienthuongkythuats'))
                                        <a href="{{route('thuong-ky-thuat.so-tien-thuong.create')}}" class="btn btn-primary btn-md mb-0">
                                            <i class="fas fa-plus" aria-hidden="true"></i> Thêm mới
                                        </a>                              
                                    @endif
                                </div>
                              </div>
                        </div>
                        <div class="card-body over-flow-y">
                            <table class="table table-borderless" id="dm-so-tien-thuong-table">
                                <thead class="bg-gradient-success text-white">
                                    <tr >    
                                      
                                        <th>
                                            Mô tả
                                            <input type="text" name="sch_mo_ta" id="sch_mo_ta" class="form-control" />
                                        </th>  
                                        <th>
                                            Tiền thưởng cơ bản
                                            <input type="text" class="form-control" disabled />
                                        </th> 
                                        <th>
                                            Tiền thưởng vượt mức
                                            <input type="text" class="form-control" disabled />
                                        </th>  
                                        <th>
                                            Số lượng vượt mức
                                            <input type="text" class="form-control" disabled />
                                        </th> 
                                        <th>
                                            Phiên bản
                                            <input type="text" class="form-control" disabled />
                                        </th> 
                                        
                                        <th>
                                            Trạng thái
                                            <input type="text" class="form-control" disabled />
                                        </th>                                                                  
                                                                                   
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                            </table>
                            
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
        table = $('#dm-so-tien-thuong-table').DataTable({
            processing: true,
            serverSide: true,
            displayLength: 10,
            ajax: {
                url:'{!! route('thuong-ky-thuat.so-tien-thuong.getData') !!}',
                method:'post',
                data: function(d){
                    // d.nhom_nv = $("#sch_nhom_nv").val();
                    // d.loai_sp = $("#sch_loai_sp").val(); 
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
                sEmptyTable:"Chưa có thông tin loại nào",
                sInfo:"Hiển thị từ _START_ to _END_ trong tổng số  _TOTAL_",
                sInfoEmpty:"Không tìm thấy kết quả nào",
                sInfoFiltered:"(lọc từ _MAX_ bản ghi)",
                sZeroRecords: "Không tìm thấy kết quả theo yêu cầu",
                sLengthMenu:"Hiển thị _MENU_ kết quả"
            },
            columns: [                
                { data: 'mo_ta', name: 'mo_ta'},                    
                { data: 'tien_thuong_co_ban', name: 'tien_thuong_co_ban' },  
                { data: 'tien_thuong_vuot_muc', name: 'tien_thuong_vuot_muc'},  
                { data: 'so_luong_gioi_han', name: 'so_luong_gioi_han' },  
                { data: 'phien_ban', name: 'phien_ban'},
                { data: 'dang_su_dung', name: 'dang_su_dung'},    
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
</x-dashboard-layout>
