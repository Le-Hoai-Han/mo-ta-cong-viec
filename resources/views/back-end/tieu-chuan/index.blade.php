<?php $current = "Danh sách tiêu chuẩn "; ?>
<x-dashboard-layout :current="$current">
    <x-slot name="title">Danh sách tiêu chuẩn</x-slot>

    <?php 
    $list = [
            '/'=>'Trang chủ',
            '#'=>'Danh sách tiêu chuẩn'
        ];
    ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-12 col-xl-4">Danh sách tiêu chuẩn</div>
                        <div class="col-12 col-xl-8 text-end">
                            {{-- @if(auth()->user()->can('add_orders')) --}}
                            <a href="{{route('tieu-chuan.create')}}" class="btn btn-primary btn-md mb-0"><i class="fas fa-plus" aria-hidden="true"></i> Thêm tiêu chuẩn</a>
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
                                        <th>Giới tính</th>
                                        <th>Tuổi</th>
                                        <th>Học vấn</th>
                                        <th>Chuyên môn</th>
                                        <th>Vi tính</th>
                                        <th>Anh ngữ</th>
                                        {{-- <th>Kinh nghiệm</th> --}}
                                        {{-- <th>Kỹ năng</th>
                                        <th>Tố chất</th>
                                        <th>Ngoại hình</th>
                                        <th>Sức khỏe</th>
                                        <th>Hộ khẩu</th>
                                        <th>Ưu tiên</th> --}}
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listTieuChuan as $tieuChuan)
                                        <tr>
                                            <td>{{$tieuChuan->viTri->ten_vi_tri}}</td>
                                            <td>{{$tieuChuan->gioi_tinh == 1?'Nam':'Nữ'}}</td>
                                            <td>{{$tieuChuan->tuoi}}</td>
                                            <td>{{$tieuChuan->hoc_van}}</td>
                                            <td>{{$tieuChuan->chuyen_mon}}</td>
                                            <td>{{$tieuChuan->vi_tinh}}</td>
                                            <td>{{$tieuChuan->anh_ngu}}</td>
                                            {{-- <td>{{$tieuChuan->kinh_nghiem}}</td> --}}
                                            {{-- <td>{{$tieuChuan->ky_nang}}</td>
                                            <td>{{$tieuChuan->to_chat}}</td>
                                            <td>{{$tieuChuan->ngoai_hinh}}</td>
                                            <td>{{$tieuChuan->suc_khoe}}</td>
                                            <td>{{$tieuChuan->ho_khau}}</td>
                                            <td>{{$tieuChuan->uu_tien}}</td> --}}
                                            <td> 
                                                <a style=""href="{{route('tieu-chuan.edit',$tieuChuan)}}">
                                                    <span class="material-icons" style="color: green">
                                                        visibility
                                                    </span>
                                                </a>
                                                <a style="" onclick="setDeleteUrl('{{route('tieu-chuan.destroy',$tieuChuan)}}')">
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