<table>
        <td style="width: 10%;height: 185px;text-align: center"><img src="{{asset('storage/'. ($viTri->user != null ? $viTri->user->profile_photo_path :''))}}" alt="" height="185px" class="img-profile"></td>
        <td style="vertical-align: top;">
            <p class="text-thong-tin"> Họ và tên: {{$nhanVien != null ?$nhanVien->name :'Đang cập nhật'}} 
                @if(auth()->user()->hasRole('Admin'))
                <a id="edit-user" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                    <span class="material-icons" style="font-size: 20px;cursor: pointer;">
                        edit
                   </span>
                </a>
                @endif
            </p>
            <p class="text-thong-tin"> Email: {{$nhanVien != null ? $nhanVien->email :'Đang cập nhật'}}</p>
            <p class="text-thong-tin"> Số điện thoại: {{$nhanVien != null && $nhanVien->profile != null ? $nhanVien->profile->phone :'Đang cập nhật'}}</p>
            
        </td>
    </tr>
<x-user-component :viTri="$viTri" :roles="$roles"/>
</table>