<?php $current = "Danh sách vị trí "; ?>
<x-dashboard-layout :current="$current">
    <x-slot name="title">Danh sách vị trí</x-slot>

    <?php
    $list = [
            '/'=>'Trang chủ',
            '#'=>'Danh sách vị trí'
        ];
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-xl-4">Danh sách vị trí</div>
                        <div class="col-12 col-xl-8 text-end">
                            {{-- @if(auth()->user()->can('add_orders')) --}}
                            <a href="{{route('vi-tri.create')}}" class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm vị trí</a>
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

                    <div class="row">
                        <div class="table-reponsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>Tên vị trí</th>
                                        <th>Phòng ban</th>
                                        <th>Cấp trên</th>
                                        <th>Nơi làm việc</th>
                                        <th>Mục đích</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listViTri as $viTri)
                                        <tr>
                                            <td>{{$viTri->ten_vi_tri}}</td>
                                            <td>{{$viTri->phong_ban}}</td>
                                            <td>{{($viTri->capQuanLy != null ? $viTri->capQuanLy->ten_vi_tri :'Không thuộc quản lý')}}</td>
                                            <td>{{$viTri->noi_lam_viec}}</td>
                                            <td>{{$viTri->muc_dich}}</td>
                                            <td>
                                                <a href="{{route('vi-tri.edit',$viTri)}}">
                                                    <span class="material-icons">
                                                         edit
                                                    </span>
                                                </a>
                                                <a onclick="setDeleteUrl('{{route('vi-tri.destroy',$viTri)}}')">
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
            // console.log(url);
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
