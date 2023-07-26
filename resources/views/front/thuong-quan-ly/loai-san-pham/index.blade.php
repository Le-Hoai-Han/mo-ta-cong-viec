<?php 
$current = "Danh mục loại sản phẩm có nhóm quản lý (supervisor)";
?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
            <div class="col-xs-12">
                <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                  <h6 class="mb-0">Danh mục loại thưởng kỹ thuật</h6>
                                </div>
                                <div class="col-6 text-end">
                                    
                                    @if(auth()->user()->can('add_loaisanphamquanlys'))
                                        <a href="{{route('thuong-quan-ly.loai-san-pham.create')}}" class="btn btn-primary btn-md mb-0">
                                            <i class="fas fa-plus" aria-hidden="true"></i> Thêm mới
                                        </a>                              
                                    @endif
                                </div>
                              </div>
                        </div>
                        <div class="card-body over-flow-y">
                            <table class="table table-borderless" id="loai-san-pham-quan-ly-table">
                                <thead class="bg-gradient-success text-white">
                                    <tr >                                        
                                        <th>
                                            Mã nhóm
                                            <input type="text" name="sch_ma_nhom_nv" id="sch_ma_nhom_nv" class="form-control" />
                                        </th>                                                                        
                                        <th>
                                            Tên nhóm
                                            <input type="text" name="sch_ten_nhom_nv" id="sch_ten_nhom_nv" class="form-control" />
                                        </th> 
                                        <th>
                                            Người quản lý
                                            <input type="text" name="sch_ten_nv" id="sch_ten_nv" class="form-control" disable readonly/>
                                        </th> 
                                        <th>
                                            Loại sản phẩm
                                            <input type="text" name="sch_loai_sp" id="sch_loai_sp" class="form-control" />
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
        table = $('#loai-san-pham-quan-ly-table').DataTable({
            processing: true,
            serverSide: true,
            displayLength: 10,
            ajax: {
                url:'{!! route('thuong-quan-ly.loai-san-pham.getData') !!}',
                method:'post',
                data: function(d){
                    d.nhom_nv = $("#sch_ma_nhom_nv").val();
                    d.ten_nhom_nv = $("#sch_ten_nhom_nv").val();
                    d.loai_sp = $("#sch_loai_sp").val(); 
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
                { data: 'ma_nhom_nhan_vien', name: 'ma_nhom_nhan_vien' },
                { data: 'ten_nhom_nhan_vien', name: 'ten_nhom_nhan_vien' },  
                { data: 'ho_ten', name: 'ho_ten' },
                { data: 'ten_loai_san_pham', name: 'ten_loai_san_pham'},                    
               
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
