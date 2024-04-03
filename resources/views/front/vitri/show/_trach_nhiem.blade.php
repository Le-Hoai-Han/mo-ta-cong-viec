<p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>4. Các trách nhiệm và nhiệm vụ chính</b>
    @if (auth()->user()->hasRole('Admin') ||
            (auth()->user()->hasRole('mo_ta_cong_viec') &&
                auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv'))
        <a id="add-trach-nhiem" style="cursor: pointer;<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
            <span class="material-icons">
                add_circle_outline
            </span>
        </a>
    @endif
</p>
<div class="trach-nhiem-nhiem-vu">
    <table>
        <thead>
            <tr>
                <th>Trách nhiệm và nhiệm vụ chính</th>
                <th>Kết quả đầu ra</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            @foreach ($viTri->nhiemVu as $nhiemVu)
                <tr id="trach-nhiem-{{ $i }}">
                    <td class="border-top-bottom-none">
                        <b style="font-size: 18px;">{{ $i++ }}. {{ $nhiemVu->ten_nhiem_vu }}</b>
                        @if (auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv'))
                            <a id="add-mo-ta-trach-nhiem" id-nhiem-vu="{{ $nhiemVu->id }}" style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                <span class="material-icons" style="font-size: 20px;cursor: pointer;">
                                    add_circle_outline
                                </span>
                            </a>
                        @endif
                        @if (auth()->user()->hasRole('Admin') ||
                                (auth()->user()->hasRole('mo_ta_cong_viec') &&
                                    auth()->user()->isCapTren($viTri)))
                            <a id="edit-trach-nhiem" id-trach-nhiem="{{ $nhiemVu->id }}" style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                <span class="material-icons" style="font-size: 20px;cursor: pointer;">
                                    edit
                                </span>
                            </a>
                            <a id="delete-trach-nhiem" id-trach-nhiem='{{ $nhiemVu->id }}' style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                <span class="material-icons" style="font-size: 20px;cursor: pointer;color:red;">
                                    delete
                                </span>
                            </a>
                        @endif
                    </td>
                    <td class="border-top-bottom-none"></td>
                </tr>
        </tbody>
        <tbody class="tbody_mo_ta">
            @foreach ($nhiemVu->moTaNhiemVu as $moTa)
                <tr style="vertical-align: top">
                    <td class="border-bottom-none">
                        <ul class="list-nhiem-vu">
                            <li>
                                {{ $moTa->chi_tiet }}
                                @if (auth()->user()->hasRole('Admin') ||
                                        (auth()->user()->hasRole('mo_ta_cong_viec') &&
                                            auth()->user()->isCapTren($viTri)))
                                    <a id="edit-mo-ta-trach-nhiem" id-nhiem-vu="{{ $nhiemVu->id }}"
                                        id-mo-ta="{{ $moTa->id }}" style="cursor: pointer;<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                        <span class="material-icons" style="font-size: 20px">
                                            edit
                                        </span>
                                    </a>
                                    <a id="delete-mo-ta-nhiem-vu" id-mo-ta="{{ $moTa->id }}"
                                        style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                        <span class="material-icons" style="font-size: 20px;cursor: pointer;color:red;">
                                            delete
                                        </span>
                                    </a>
                                @endif
                            </li>

                            {{-- @if (auth()->user()->hasRole('Admin') ||
                                    (auth()->user()->hasRole('mo_ta_cong_viec') &&
                                        auth()->user()->isCapTren($viTri)))
                                <a id="add-mo-ta-trach-nhiem" id-nhiem-vu="{{ $nhiemVu->id }}"
                                    style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                    <span class="material-icons" style="font-size: 20px;cursor: pointer;">
                                        add_circle_outline
                                    </span>
                                </a>
                            @endif --}}
                        </ul>
                    </td>
                    <td class="border-bottom-none">
                        <ul class="list-nhiem-vu">
                            <li>
                                {{ $moTa->ket_qua }}
                            </li>
                        </ul>
                    </td>
                </tr>
            @endforeach
    
            @endforeach
            <x-mo-ta-nhiem-vu :listNhiemVu="$listNhiemVu" :nhiemVuHienTai="$viTri->nhiemVu->isNotEmpty() ? $nhiemVu : []" />
            <x-trach-nhiem :nhiemVu="$viTri->nhiemVu->isNotEmpty() ? $nhiemVu : []" :listViTri="$listViTri" :viTriHienTai="$viTri" />
        </tbody>
    </table>
</div>
@push('scripts')
    <script>
        // phương thức thông báo biến mất theo time 
        function closeSetTimeOut(time, modal) {
            setTimeout(() => {
                $('#thong-bao-trang-thai').fadeOut(time, function() {
                    modal.classList.remove('show');
                })
            }, time);
            location.reload();


        }

        // refresh
        function refresh(id) {
            location.reload();
        }

        // phương thức mở modal
        function openModal(modal) {
            modal.classList.add('show');
        }

        // phương thức đóng modal
        function closeModal(modal) {
            modal.classList.remove('show');
        }

    

    </script>
@endpush
