<table>
    <tr>
        <td colspan="2"><b>1. Mô tả chung về chức danh/vị trí công việc</b>
            @if(auth()->user()->hasRole('mo_ta_cong_viec') 
            // Trường hợp vừa có quyền và vừa là cấp trên
            &&  auth()->user()->isViTri($viTri) || auth()->user()->hasRole('admin'))
            <a id="add-vi-tri" vi-tri="{{$viTri}}" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                <span class="material-icons" style="color: green">
                    add_circle_outline
                </span>
            </a>
            @endif
            @if (auth()->user()->hasRole('admin') ||
                    (auth()->user()->hasRole('mo_ta_cong_viec') &&
                        auth()->user()->isCapTren($viTri)))
                
                    <a id="edit-vi-tri" vi-tri="{{$viTri}}" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                        <span class="material-icons">
                            edit
                        </span>
                    </a>
                    <a id="delete-vi-tri" vi-tri="{{$viTri}}" style="cursor: pointer;color:red;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                        <span class="material-icons">
                            delete
                        </span>
                    </a>       
                    <a id="lock-vi-tri" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-vi-tri="{{ $viTri->id }}">
                        <span class="material-icons" style="color: green">
                            lock_open
                        </span>
                    </a>
                    <a id="unlock-vi-tri" style="cursor: pointer;">
                        <span class="material-icons" style="color: red;<?php echo ($viTri->trang_thai == 0 ? 'display:none' :'') ?>">
                            lock
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
            <p>{{ $viTri->ten_vi_tri }}</p>
        </td>
    </tr>
    <tr>
        <td class="">
            <p>Phòng ban</p>
        </td>
        <td>
            <p>{{ $viTri->phong_ban }}</p>
        </td>

    </tr>
    @if($viTri->id != 2)
    <tr>
        <td class="">
            <p>Cấp quản lý trực tiếp</p>
        </td>
        <td>
            <p>{{ $viTri->capQuanly->ten_vi_tri }}</p>
        </td>
    </tr>
    @endif
    <tr>
        <td class="">
            <p>Nơi làm việc</p>
        </td>
        <td>
            <p>{{ $viTri->noi_lam_viec }}</p>
        </td>
    </tr>
    <tr>
        <td colspan=""><b>2. Mục đích công việc vị trí</b></td>
        <td>
            <p><?php echo nl2br($viTri->muc_dich) ?></p>
        </td>
    </tr>
</table>
<x-xac-nhan id="xac-nhan-lock" class="alert-danger">
    <x-slot name="title">Xác nhận</x-slot>
    <x-slot name="body">Vị trí sẽ khóa thông tin..</x-slot>
    <x-slot name="buttonClose">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
            id="btn-close-xac-nhan-lock">Đóng</button>
    </x-slot>
    <x-slot name="button">
        <button type="button" class="btn btn-danger" onclick="khoaViTri()">Khóa</button>
    </x-slot>
</x-xac-nhan>

<x-xac-nhan id="xac-nhan-unlock" class="alert-danger">
    <x-slot name="title">Xác nhận</x-slot>
    <x-slot name="body">Vị trí sẽ được mở khóa</x-slot>
    <x-slot name="buttonClose">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
            id="btn-close-xac-nhan-unlock">Đóng</button>
    </x-slot>
    <x-slot name="button">
        <button type="button" class="btn btn-danger" onclick="moViTri()">Mở khóa</button>
    </x-slot>
</x-xac-nhan>



<x-vi-tri :viTri="$viTri" :listViTri="$listViTri" :listUser="$listUser" />
@push('scripts')
    <script>
        var btnUnlockVitri = document.getElementById('unlock-vi-tri');
        var btnLockVitri = document.getElementById('lock-vi-tri');
        var modalXacNhanLock = document.getElementById('xac-nhan-lock');
        var modalXacNhanUnLock = document.getElementById('xac-nhan-unlock');
        var btnCloseXacNhanLock = document.getElementById('btn-close-xac-nhan-lock');
        var btnCloseXacNhanUnLock = document.getElementById('btn-close-xac-nhan-unlock');
        


        if(btnLockVitri != null){
            btnLockVitri.addEventListener("click", function() {
                modalXacNhanLock.classList.add('show');
            })
            var idViTri = btnLockVitri.getAttribute('id-vi-tri');
        }

        if(btnUnlockVitri){
            btnUnlockVitri.addEventListener("click", function() {
                modalXacNhanUnLock.classList.add('show');
            })
        }


        btnCloseXacNhanLock.addEventListener("click", function() {
            modalXacNhanLock.classList.remove('show');
        })

        btnCloseXacNhanUnLock.addEventListener("click", function() {
            modalXacNhanUnLock.classList.remove('show');
        })

        function khoaViTri() {
            $.ajax({
                url: "{{url('front-vi-tri-lock')}}/"+idViTri,
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(res) {
                    modalXacNhanLock.classList.remove('show');
                    if (res.status == 'success') {
                    $('#thong-bao-trang-thai').removeClass('alert-danger').addClass('alert-success').html(res.message).show();
                } else {
                    $('#thong-bao-trang-thai').removeClass('alert-success').addClass('alert-danger').html(res.message).show();
                }

                closeSetTimeOut(500);
                    
                },
            })
        }

        function moViTri() {
            $.ajax({
                url: "{{url('front-vi-tri-unlock')}}/"+idViTri,
                type: 'GET',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function(res) {
                    modalXacNhanUnLock.classList.remove('show');
                    if (res.status == 'success') {
                        $('#thong-bao-trang-thai').removeClass('alert-danger').addClass('alert-success').html(res.message).show();
                    } else {
                        $('#thong-bao-trang-thai').removeClass('alert-success').addClass('alert-danger').html(res.message).show();
                    }

                    closeSetTimeOut(500);
                },
            })
        }
    </script>
@endpush
