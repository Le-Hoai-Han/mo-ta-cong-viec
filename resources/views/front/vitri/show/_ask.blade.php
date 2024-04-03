<div class="ask">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de">
        <b>8. ASK (Attitude - Skill - Knowledge)</b>
        @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv'))
            <a id="btn_add_ask" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-vi-tri="{{$viTri->id}}">
                <span class="material-icons">
                    add_circle_outline
                </span>
            </a>
        @endif
    </p>
        <table>
        <thead>
            <tr>
                <th>Attitude (Thái độ)</th>
                <th>Skill (Kỹ năng)</th>
                <th>Knowledge (Kiến thức)</th>
            </tr>
        </thead>
        <tbody>
            
            <tr>
                <td>
                    <ul class="list-quan-he">
                        @foreach($viTri->ASK->where('loai',0) as $item)
                            <li>{{$item->noi_dung}}
                                @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv'))
                                    <a id="btn_edit_ask" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-ask="{{$item->id}}">
                                        <span class="material-icons" style="font-size: 20px">
                                            edit
                                        </span>
                                    </a>
                                    <a id="btn_delete_ask" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-ask="{{$item->id}}">
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
                        @foreach($viTri->ASK->where('loai',1) as $item)
                            <li>{{$item->noi_dung}}
                                @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
                                    <a id="btn_edit_ask" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-ask="{{$item->id}}">
                                        <span class="material-icons" style="font-size: 20px">
                                            edit
                                        </span>
                                    </a>
                                    <a id="btn_delete_ask" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-ask="{{$item->id}}">
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
                        @foreach($viTri->ASK->where('loai',2) as $item)
                            <li>{{$item->noi_dung}}
                                @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
                                    <a id="btn_edit_ask" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-ask="{{$item->id}}">
                                        <span class="material-icons" style="font-size: 20px">
                                            edit
                                        </span>
                                    </a>
                                    <a id="btn_delete_ask" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-ask="{{$item->id}}">
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
        <x-a-s-k :listViTri="$listViTri" :viTri="$viTri"/>
</div>