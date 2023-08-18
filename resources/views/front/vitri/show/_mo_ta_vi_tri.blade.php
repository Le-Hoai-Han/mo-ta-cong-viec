<table>
            <tr>
                <td colspan="2"><b>1. Mô tả chung về chức danh/vị trí công việc</b></td>
            </tr>
            <tr>
                <td><p>Chức danh công việc</p></td>
                <td>{{$viTri->ten_vi_tri}}</td>
            </tr>
            <tr>
                <td class="">
                    <p>Phòng ban</p>
                </td>
                <td>{{$viTri->phong_ban}}</td>
               
            </tr>
            <tr>
                <td class="">
                    <p>Cấp quản lý trực tiếp</p>
                </td>
                <td>{{$viTri->capQuanly->ten_vi_tri}}</td>
            </tr>
            <tr>
                <td class="">
                    <p>Nơi làm việc</p>
                </td>
                <td>
                    <p>{{$viTri->noi_lam_viec}}</p>
                </td>
            </tr>
            <tr>
                <td colspan=""><b>2. Mục đích công việc vị trí</b></td>
                <td>
                    <p>{{$viTri->muc_dich}}</p>
                </td>
            </tr>
        </table>