<div class="tieu-chuan-tuyen-chon">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de">
        <b>7. Tiêu chuẩn tuyển chọn</b>
        @if( (auth()->user()->hasRole('Admin') && $viTri->tieuChuan->isEmpty()) || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) && $viTri->tieuChuan->isEmpty() || auth()->user()->hasPermissionTo('edit_mtcv') && $viTri->tieuChuan->isNotEmpty())
            <a id="btn_add_tieu_chuan" id-vi-tri="{{$viTri->id}}" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                <span class="material-icons">
                    add_circle_outline
                </span>
            </a>
            
        @endif
    </p>
        <table>
        <thead>
            <tr>
                <th>Tiêu chí</th>
                <th>
                    Yêu cầu
                @if((auth()->user()->hasRole('Admin') || auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) && $viTri->tieuChuan->isNotEmpty() || auth()->user()->hasPermissionTo('edit_mtcv') && $viTri->tieuChuan->isNotEmpty())
                    <a id="btn_edit_tieu_chuan" id-tieu-chuan="{{$viTri->tieuChuan[0]->id}}" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                        <span class="material-icons">
                            edit
                        </span>
                    </a>
                @endif
                </th>
            </tr>
        </thead>
        <tbody>

            @foreach($viTri->tieuChuan as $tieuChi)
                <tr>
                    <td>Giới tính</td>
                    <td> <p>{{$tieuChi->gioi_tinh == 0 ? 'Nam' :'Nữ'}}</p></td>
                </tr>
                <tr>
                    <td>Độ tuổi</td>
                    <td><p>{{$tieuChi->tuoi}}</p></td>
                </tr>
                <tr>
                    <td>Học vấn</td>
                    <td> <p>{{$tieuChi->hoc_van}}</p></td>
                </tr>
                <tr>
                    <td>Chuyên môn</td>
                    <td><p>{{$tieuChi->chuyen_mon}}</p></td>
                </tr>
                <tr>
                    <td>Vi tính</td>
                    <td> <p>{{$tieuChi->vi_tinh}}</p></td>
                </tr>
                <tr>
                    <td>Anh ngữ</td>
                    <td><p>{{$tieuChi->anh_ngu}}</p></td>
                </tr>
                <tr>
                    <td>Kinh nghiệm</td>
                    <td><p>{{$tieuChi->kinh_nghiem}}</p></td>
                </tr>
                <tr>
                    <td>Kỹ năng cần có</td>
                    <td>  <p>{{$tieuChi->ky_nang}}</p></td>
                </tr>
                <tr>
                    <td>Thái độ/tố chất cần có</td>
                    <td>   <p>{{$tieuChi->to_chat}}</p></td>
                </tr>
                <tr>
                    <td>Ngoại hình</td>
                    <td><p>{{$tieuChi->ngoai_hinh}}</p></td>
                </tr>
                <tr>
                    <td>Sức khỏe</td>
                    <td> <p>{{$tieuChi->suc_khoe}}</p></td>
                </tr>
                <tr>
                    <td>Hộ khẩu thường trú</td>
                    <td> <p>{{$tieuChi->ho_khau}}</p></td>
                </tr>
                <tr>
                    <td>Ưu tiên</td>
                    <td><p>{{$tieuChi->uu_tien}}</p></td>
                </tr>
                <tr>
                    <td>Khác</td>
                    <td><p>{{$tieuChi->khac}}</p></td>
                </tr>
            @endforeach
        </tbody>
        </table>
    <x-tieu-chuan :viTri="$viTri" :listViTri="$listViTri" />
</div>