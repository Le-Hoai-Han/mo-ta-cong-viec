@push('styles')
<style>
    .size-40 {
        width: 10rem; /* Tương đương với tailwind's `size-8` */
        height: 10rem; /* Tương đương với tailwind's `size-8` */
    }

.rounded-full {
  border-radius: 9999px; /* Giá trị lớn để tạo hình tròn hoàn toàn */
}

.overflow-hidden {
  overflow: hidden;
}

.w-full {
    width: 100%;
}

.h-full {
    height: 100%;
}

.object-cover {
    object-fit: cover;
}

</style>
@endpush
<table>
        <td style="width: 20%;height: 185px;text-align: center">
            <div class="w-full h-full overflow-hidden flex">
                <img src="{{'https://drive.3d-smartsolutions.com/storage/'. ($viTri->user != null ? $viTri->user->profile_photo_path :'')}}" class="w-full object-cover" style="height: 200px" />
            </div>
        </td>
        <td style="vertical-align: top;">
            <p class="text-thong-tin"> Họ và tên: {{$nhanVien != null ?$nhanVien->name :'Đang cập nhật'}}
                {{-- @if(auth()->user()->hasRole('Admin'))
                <a id="edit-user" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                    <span class="material-icons" style="font-size: 20px;cursor: pointer;">
                        edit
                   </span>
                </a>
                @endif --}}
            </p>
            <p class="text-thong-tin"> Email: {{$nhanVien != null ? $nhanVien->email :'Đang cập nhật'}}</p>
            <p class="text-thong-tin"> Số điện thoại: {{$nhanVien != null && $nhanVien->profile != null ? $nhanVien->profile->phone :'Đang cập nhật'}}</p>

        </td>
    </tr>
<x-user-component :viTri="$viTri" :roles="$roles"/>
</table>
