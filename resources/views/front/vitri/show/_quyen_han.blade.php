<div class="tham-quyen">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>5. Thẩm quyền/Quyền hạn</b>
        @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv'))
        <a style="cursor: pointer;<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>" id="btn-add-tham-quyen" id-vi-tri="{{$viTri->id}}">
            <span class="material-icons">
                add_circle_outline
           </span>
        </a>
        @endif
    </p>
        <table>
        <thead>
            <tr>
                <th>Đề xuất</th>
                <th>Ra quyết định</th>
            </tr>
        </thead>
        <tbody>
                <tr>
                    <td>
                        <ul class="list-tham-quyen">
                            @foreach($viTri->thamQuyen->where('loai',1) as $thamQuyen)
                                <li>
                                    {{$thamQuyen->noi_dung}} 
                                    @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
                                        <a id="btn-edit-tham-quyen" id-vi-tri="{{$viTri->id}}" id-tham-quyen="{{$thamQuyen->id}}" style="cursor: pointer;<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
                                            <span class="material-icons" style="font-size: 18px">
                                                edit
                                            </span>
                                        </a>
                                        <a id="btn-delete-tham-quyen" id-vi-tri="{{$viTri->id}}" id-tham-quyen="{{$thamQuyen->id}}" style="cursor: pointer;<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
                                            <span class="material-icons" style="font-size: 18px;color: red">
                                                delete
                                            </span>
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul class="list-tham-quyen">
                            @foreach($viTri->thamQuyen->where('loai',2) as $thamQuyen)
                            <li>
                                {{$thamQuyen->noi_dung}} 
                                @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv'))
                                    <a id="btn-edit-tham-quyen" id-vi-tri="{{$viTri->id}}" id-tham-quyen="{{$thamQuyen->id}}" style="cursor: pointer;<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
                                        <span class="material-icons" style="font-size: 18px">
                                            edit
                                        </span>
                                    </a>
                                    <a id="btn-delete-tham-quyen" id-vi-tri="{{$viTri->id}}" id-tham-quyen="{{$thamQuyen->id}}" style="cursor: pointer;<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
                                        <span class="material-icons" style="font-size: 18px;color: red">
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
    </div>
    <x-tham-quyen :listViTri="$listViTri" :viTri="$viTri"/>