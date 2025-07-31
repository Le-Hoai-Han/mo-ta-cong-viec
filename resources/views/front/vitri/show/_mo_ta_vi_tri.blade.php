<table>
    <tr>
        <td colspan="2"><b>{{ $sectionNumber }}. Mô tả chung về chức danh/vị trí công việc</b>
            @if(auth()->user()->hasRole('mo_ta_cong_viec')
            // Trường hợp vừa có quyền và vừa là cấp trên
            &&  auth()->user()->isViTri($viTri) || auth()->user()->hasRole('Admin') || auth()->user()->hasPermissionTo('add_mtcv'))
            <a id="add-vi-tri" vi-tri="{{$viTri}}" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                <span class="material-icons" style="color: green">
                    add_circle_outline
                </span>
            </a>
            @endif
            @php
                $sectionNumber++;
            @endphp
            @if ($kiemTra)

                    <a title="Sửa vị trí" id="edit-vi-tri" vi-tri="{{$viTri}}" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                        <span class="material-icons">
                            edit
                        </span>
                    </a>
                    <a title="Xóa vị trí" onclick="xacNhanYeuCauXoaViTri()" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                        <span class="material-icons delete">
                            delete
                        </span>
                    </a>
                    <a title="Khóa" onclick="xacNhanKhoaViTri(this,{{ $viTri->id }})" data-action="khoa" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-vi-tri="{{ $viTri->id }}">
                        <span class="material-icons" style="color: green">
                            lock_open
                        </span>
                    </a>
                    <a title="Mở khóa" onclick="xacNhanKhoaViTri(this,{{ $viTri->id }})" data-action="mo-khoa">
                        <span class="material-icons delete" style="color: red;<?php echo ($viTri->trang_thai == 0 ? 'display:none' :'') ?>">
                            lock
                        </span>
                    </a>
                    <a href="{{ route('front-vi-tri.history', $viTri->id) }}" title="Lịch sử thay đổi">
                        <span class="material-icons">
                            history
                        </span>
                    </a>

            @endif

        </td>
    </tr>
    <tr>
        <td>
            <p>Chức danh công việc</p>
        </td>
        <td>
            @if ($kiemTra)
                <div data-action="updateViTri" data-fillable="ten_vi_tri" ondblclick="editTask(this, {{$viTri->id}})">
                    <p id="ten_vi_tri">{{ $viTri->ten_vi_tri }}</p>
                </div>
            @else
            <div data-action="updateViTri" data-fillable="ten_vi_tri">
                    <p id="ten_vi_tri">{{ $viTri->ten_vi_tri }}</p>
                </div>
            @endif
        </td>
    </tr>
    <tr>
        <td class="">
            <p>Phòng ban</p>
        </td>
        <td>
        @if ($kiemTra)
            <div data-action="updateViTri" data-id="{{ $viTri->phongBan ? $viTri->phongBan->id : '' }}"  data-fillable="phong_ban" ondblclick="editTask(this, {{$viTri->id}})">
                <p>{{ $viTri->phongBan ? $viTri->phongBan->name :'Chưa cập nhật' }}</p>
            </div>
        @else
        <div data-action="updateViTri" data-id="{{ $viTri->phongBan->id }}"  data-fillable="phong_ban">
                <p>{{ $viTri->phongBan ? $viTri->phongBan->name :'Chưa cập nhật' }}</p>
            </div>
        @endif
        </td>

    </tr>
    @if($viTri->id != 2)
    <tr>
        <td class="">
            <p>Cấp quản lý trực tiếp</p>
        </td>
        <td>
        @if ($kiemTra)
            <div data-action="updateViTri" data-id="{{ $viTri->capQuanly->id }}" data-fillable="id_vi_tri_quan_ly" ondblclick="editTask(this, {{$viTri->id}})">
                <p id="id_vi_tri_quan_ly">{{ $viTri->capQuanly ?  $viTri->capQuanly->ten_vi_tri :'Chưa cập nhật' }}</p>
            </div>
        @else
        <div data-action="updateViTri" data-id="{{ $viTri->capQuanly->id }}" data-fillable="id_vi_tri_quan_ly">
                <p id="id_vi_tri_quan_ly">{{ $viTri->capQuanly ?  $viTri->capQuanly->ten_vi_tri :'Chưa cập nhật' }}</p>
            </div>
        @endif
        </td>
    </tr>
    @endif
    <tr>
        <td class="">
            <p>Nơi làm việc</p>
        </td>
        <td>
        @if ($kiemTra)
            <div data-action="updateViTri" data-fillable="noi_lam_viec" ondblclick="editTask(this, {{$viTri->id}})">
                <p>{{ $viTri->noi_lam_viec }}</p>
            </div>
        @else
        <div data-action="updateViTri" data-fillable="noi_lam_viec">
                <p>{{ $viTri->noi_lam_viec }}</p>
            </div>
        @endif
        </td>
    </tr>
    <tr>
        <td colspan="">
            <b>{{ $sectionNumber }}. Mục đích công việc vị trí</b>
        </td>
        <td>
        @if ($kiemTra)
            <div data-action="updateViTri" data-fillable="muc_dich" ondblclick="editTask(this, {{$viTri->id}})">
                <p><?php echo nl2br($viTri->muc_dich ?? '...')  ?></p>
            </div>
        @else
            <div data-action="updateViTri" data-fillable="muc_dich">
                <p><?php echo nl2br($viTri->muc_dich ?? '...')  ?></p>
            </div>
        @endif
        </td>
    </tr>
</table>


<x-vi-tri :viTri="$viTri" :listViTri="$listViTri" :listUser="$listUser" :listPhongBan="$listPhongBan" />
@push('scripts')
    <script>
        var btnUnlockVitri = document.getElementById('unlock-vi-tri');
        var btnLockVitri = document.getElementById('lock-vi-tri');
        var modalXacNhanLock = document.getElementById('xac-nhan-lock');
        var modalXacNhanUnLock = document.getElementById('xac-nhan-unlock');
        var btnCloseXacNhanLock = document.getElementById('btn-close-xac-nhan-lock');
        var btnCloseXacNhanUnLock = document.getElementById('btn-close-xac-nhan-unlock');

        function khoaViTri(id) {
            $.ajax({
                url: "{{url('front-vi-tri-lock')}}/"+id,
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(res) {
                    modalXacNhanLock.classList.remove('show');
                    if (res.status == 'success') {
                        hienThongBao('Khóa vị trí thành công');
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    } else {
                        hienLoi('Khóa vị trí thất bại');
                            setTimeout(function() {
                                    location.reload();
                                }, 500);
                    }

                closeSetTimeOut(500);

                },
            })
        }

        function moViTri(id) {
            $.ajax({
                url: "{{url('front-vi-tri-unlock')}}/"+id,
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(res) {
                    modalXacNhanUnLock.classList.remove('show');
                    if (res.status == 'success') {
                        hienThongBao('Mở vị trí thành công');
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    } else {
                        hienLoi('Mở vị trí thất bại');
                            setTimeout(function() {
                                    location.reload();
                                }, 500);
                    }

                    closeSetTimeOut(500);
                },
            })
        }

        function xacNhanKhoaViTri(element,id)
        {
            let action = element.getAttribute('data-action');
            let text = 'mở khóa';
            if(action == 'khoa'){
                text = 'khóa'
            }
            Swal.fire({
                title: "Xác nhận",
                text: `Bạn có chắc chắn ${text} vị trí này`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                confirmButtonColor: "#B52227",
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    if(action == 'khoa'){
                        khoaViTri(id)
                    }else{
                        moViTri(id);
                    }
                }
            });
        }

        function xacNhanYeuCauXoaViTri()
        {
            Swal.fire({
                title: "Xác nhận",
                text: `Bạn có chắc chắn muốn xóa vị trí này?
                Vị trí sẽ bị xóa.Các mô tả liên quan đến vị trí sẽ bị xóa và không được phục hồi...`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                confirmButtonColor: "#B52227",
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    xoaViTri()
                }
            });
        }

        function xoaViTri(){
            $.ajax({
                url:"{{route('front-vi-tri.destroy',$viTri)}}",
                type:'delete',
                dataType:'json',
                data:{
                    _token:'{{csrf_token()}}',
                },
                success:function(res){

                    if(res.status == 'success'){
                        hienThongBao('Xóa thành công');
                        window.location.href = '/';
                    }else{
                        hienLoi('Xóa vị trí thất bại');
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }

                    window.location="/";
                }
            })
        }
    </script>
@endpush
