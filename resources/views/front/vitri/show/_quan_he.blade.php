<div class="quan-he">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de">
        <b>6. Quan hệ công việc</b>
        @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
            <a id="btn_add_quan_he" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-vi-tri="{{$viTri->id}}">
                <span class="material-icons">
                    add_circle_outline
                </span>
            </a>
        @endif
    </p>
        <table>
        <thead>
            <tr>
                <th>Bên trong công ty</th>
                <th>Bên ngoài công ty</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <ul class="list-quan-he">
                            @foreach($viTri->quanHe->where('loai',0) as $quanHe)
                                <li>{{$quanHe->noi_dung}}
                                    @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
                                        <a id="btn_edit_quan_he" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-quan-he="{{$quanHe->id}}">
                                            <span class="material-icons" style="font-size: 20px">
                                                edit
                                            </span>
                                        </a>
                                        <a id="btn_delete_quan_he" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-quan-he="{{$quanHe->id}}">
                                            <span class="material-icons" style="font-size: 20px;color:red">
                                                delete
                                            </span>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-quan-he">
                            @foreach($viTri->quanHe->where('loai',1) as $quanHe)
                                <li>{{$quanHe->noi_dung}}
                                    @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
                                        <a id="btn_edit_quan_he" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-quan-he="{{$quanHe->id}}">
                                            <span class="material-icons" style="font-size: 20px">
                                                edit
                                            </span>
                                        </a>
                                        <a id="btn_delete_quan_he" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-quan-he="{{$quanHe->id}}">
                                            <span class="material-icons" style="font-size: 20px;color:red">
                                                delete
                                            </span>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
        </tbody>
        </table>
        <x-quan-he :listViTri="$listViTri" :viTri="$viTri"/>
</div>