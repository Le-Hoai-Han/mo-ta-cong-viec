<?php 
$current = "Danh mục loại thưởng kỹ thuật";
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
                                    
                                    @if(auth()->user()->can('add_loaithuongkythuats'))
                                        <a href="{{route('thuong-ky-thuat.loai-thuong-ky-thuat.create')}}" class="btn btn-primary btn-md mb-0">
                                            <i class="fas fa-plus" aria-hidden="true"></i> Thêm mới
                                        </a>                              
                                    @endif
                                </div>
                              </div>
                        </div>
                        <div class="card-body over-flow-y">
                            <div class="">
                                @if(Session::has('status'))
                                    <div class="alert bg-success text-white">{{Session::get('status')}}</div>
                                @endif
                                <table class="table table-borderless" id="no-xau-table">
                                    <thead class="bg-gradient-success text-white">
                                        <tr >
                                            <th style="width:50px;">
                                            ID
                                            </th>
                                            <th style="width:200px">
                                                Mã loại
                                            </th>                                                                        
                                            <th>
                                                Tên loại
                                            </th>                                            
                                            <th style="min-width:400px">Mô tả</th> 
                                            <th>Hành động
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($dsLoaiThuongKyThuat as $loaiThuongKyThuat)
                                            <tr id="row_{{$loaiThuongKyThuat->id}}" >
                                                <td>
                                                    {{$loaiThuongKyThuat->id}}
                                                </td>                                        
                                                <td>
                                                    {{$loaiThuongKyThuat->ma_loai}}
                                                </td>                                                                        
                                                <td>
                                                    {{$loaiThuongKyThuat->ten_loai}}
                                                </td>                                            
                                                <td>
                                                    {{$loaiThuongKyThuat->mo_ta}}
                                                </td>  
                                                <td>
                                                    @can('edit_loaithuongkythuats')
                                                        <?php 
                                                            $linkCapNhat = route('thuong-ky-thuat.loai-thuong-ky-thuat.edit',$loaiThuongKyThuat);
                                                        ?>
                                                        <x-link-cap-nhat label="" :route="$linkCapNhat"/>
                                                    @endcan 

                                                    @can('delete_loaithuongkythuats')
                                                        <?php 
                                                            $linkXoaLoai = route('thuong-ky-thuat.loai-thuong-ky-thuat.destroy',$loaiThuongKyThuat);
                                                        ?>
                                                        <x-link-xoa label="" :route="$linkXoaLoai" />    
                                                    @endcan
                                                </td>
                                            </tr>
                                        @empty 
                                        <tr>
                                            <th colspan='5'>Chưa có loại thưởng kỹ thuật nào</th>
                                        </tr>
                                        @endforelse

                                    </tbody>
                                
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        
        let deleteUrl = '';
        function setDeleteUrl(url) {

            if(confirm('Xóa loại này?')) {
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


                        var row = document.getElementById(res.rowID);
                        console.log(row);
                        // Remove the row from the table
                        row.parentNode.removeChild(row);
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
