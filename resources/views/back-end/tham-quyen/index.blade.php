<?php $current = "Thẩm quyền "; ?>
<x-dashboard-layout :current="$current">
    <x-slot name="title">Thẩm quyền</x-slot>

    <?php 
    $list = [
            '/'=>'Trang chủ',
            '#'=>'Thẩm quyền'
        ];
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-xl-4">Thẩm quyền</div>
                        <div class="col-12 col-xl-8 text-end">
                            {{-- @if(auth()->user()->can('add_orders')) --}}
                            {{-- <a href="{{route('vi-tri.show',$viTri)}}" class="btn btn-dark btn-md mb-0">Trở về</a> --}}
                            <a href="{{route('tham-quyen.create')}}" class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm</a>
                            {{-- @endif --}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach

                        </div><br>
                    @endif          

                    @if(Session::has('error'))
                        <div style="color:white" class="alert alert-danger">{{Session::get('error')}}</div>
                    @endif

                    @if(Session::has('success'))
                    <div style="color:white" class="alert alert-success">{{Session::get('success')}}</div>
                @endif

                    <div class="row">
                        <div class="table-reponsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Vị trí</th>
                                        <th>Nội dung</th>
                                        <th>Loại</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listThamQuyen as $thamQuyen)
                                        <tr>
                                            <td>{{($thamQuyen->viTri != null ? $thamQuyen->viTri->ten_vi_tri :'Không thuộc quản lý')}}</td>
                                            <td>{{$thamQuyen->noi_dung}}</td>
                                            <td>{{$thamQuyen->loai == 1 ? 'Đề xuất':'Ra quyết định' }}</td>
                                            <td>
                                                <a href="{{route('tham-quyen.edit',$thamQuyen)}}">
                                                    <span class="material-icons">
                                                         edit
                                                    </span>
                                                </a>
                                                <a onclick="setDeleteUrl('{{route('tham-quyen.destroy',$thamQuyen)}}')">
                                                    <span class="material-icons" style="color: red;cursor: pointer;">
                                                         delete
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <x-modal-bootstrap id="deleteModal" class="alert-danger"> 
        <x-slot name="title">Xác nhận</x-slot>
        <x-slot name="body">Nội dung bị xóa sẽ không thể khôi phục. Xác nhận xóa?</x-slot>
        <x-slot name="button">
            <button type="button" class="btn btn-danger" onclick="deleteRow()">Tôi muốn xóa.</button>
        </x-slot>
    </x-modal-bootstrap>

    <script>
         let table;
        let deleteUrl = '';
        function setDeleteUrl(url) {
            console.log(url);
            deleteUrl = url;
            $("#deleteModal").modal('show');
        }

        function deleteRow() {
            $.ajax({
                url: deleteUrl,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",
                    "_method": "DELETE"
                },
                success:function(res) {
                    // console.log('ok');
                    $("#deleteModal").modal('hide');
                    // table.ajax.reload(null,false);
                    location.reload();
                    deleteUrl = '';
                    
                }
            });
        }
    </script>
</x-main-layout>