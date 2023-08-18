<table>
    <tr>
        <td style="width: 10%;"><img src="{{asset('storage/'. $viTri->user->profile_photo_path)}}" alt="" height="300px" class="img-profile"></td>
        <td style="vertical-align: top;">
            <p class="text-thong-tin"> Họ và tên: {{$nhanVien->name}}</p>
            <p class="text-thong-tin"> Số điện thoại: {{$nhanVien->sdt}}</p>
            @if(auth()->user()->hasRole('admin'))
                <button class="btn btn-warning">Cập nhật</button>
            @endif
        </td>
    </tr>
    
</table>