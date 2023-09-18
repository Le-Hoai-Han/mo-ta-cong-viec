
    <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>4. Các trách nhiệm và nhiệm vụ chính</b>
        @if(auth()->user()->hasRole('admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
            <a id="add-trach-nhiem" style="cursor: pointer;<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
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
            @foreach($viTri->nhiemVu as $nhiemVu)
                <tr>
                    <td>
                        <p style="font-size: 18px;"> <b>Trách nhiệm thứ {{$i++}}. {{$nhiemVu->ten_nhiem_vu}}</b>
                            @if(auth()->user()->hasRole('admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
                                <a id="edit-trach-nhiem" id-trach-nhiem="{{$nhiemVu->id}}" style="<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
                                    <span class="material-icons" style="font-size: 20px;cursor: pointer;">
                                        edit
                                </span>
                                </a>
                                <a id="delete-trach-nhiem" id-trach-nhiem='{{$nhiemVu->id}}' style="<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
                                    <span class="material-icons" style="font-size: 20px;cursor: pointer;color:red;">
                                        delete
                                </span>
                                </a>
                            @endif
                        </p>
                        <ul class="list-nhiem-vu">
                            @foreach($nhiemVu->moTaNhiemVu as $moTa)
                                <li>
                                    {{$moTa->chi_tiet}} 
                                    @if(auth()->user()->hasRole('admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
                                        <a id="edit-mo-ta-trach-nhiem" id-nhiem-vu="{{$nhiemVu->id}}" id-mo-ta="{{$moTa->id}}" style="cursor: pointer;<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
                                            <span class="material-icons" style="font-size: 20px">
                                                edit
                                            </span>
                                        </a>
                                        <a id="delete-mo-ta-nhiem-vu" id-mo-ta="{{$moTa->id}}" style="<?php echo  ($viTri->trang_thai != 0 ? 'display:none':'') ?>">
                                            <span class="material-icons" style="font-size: 20px;cursor: pointer;color:red;">
                                                delete
                                        </span>
                                        </a>
                                    @endif
                                </li>
                                
                            @endforeach
                            @if(auth()->user()->hasRole('admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)))
                            <a id="add-mo-ta-trach-nhiem" id-nhiem-vu="{{$nhiemVu->id}}" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                                <span class="material-icons" style="font-size: 20px;cursor: pointer;">
                                    add_circle_outline
                               </span>
                            </a>
                            @endif
                        </ul>
                    </td>
                    <td>
                        <p><br></p>
                        <ul class="list-nhiem-vu">
                            @foreach($nhiemVu->moTaNhiemVu as $moTa)
                                <li>
                                    {{$moTa->ket_qua}} 
                                </li>
                                
                            @endforeach
                           
                        </ul>
                    </td>
                </tr>
                @endforeach
                <x-mo-ta-nhiem-vu :listNhiemVu="$listNhiemVu" :nhiemVuHienTai="($viTri->nhiemVu->isNotEmpty() ? $nhiemVu :[])" />
                <x-trach-nhiem :nhiemVu="($viTri->nhiemVu->isNotEmpty() ? $nhiemVu :[])" :listViTri="$listViTri" :viTriHienTai="$viTri"/>
            </tbody>
        </table>
    </div>
    @push('scripts')
    <script>
        
        function showChiTiet(){
            let showChiTiet = document.getElementById('show-chi-tiet');
            let xemThem = document.getElementById('xem-them');
            showChiTiet.style.display = "block";
            xemThem.style.display = "none";
        }

        // phương thức thông báo biến mất theo time 
         function closeSetTimeOut(time,modal){
                setTimeout(() => {
                    $('#thong-bao-trang-thai').fadeOut(time,function(){
                        modal.classList.remove('show');
                    })
                }, time);
                location.reload();

               
            }

        // phương thức mở modal
        function openModal(modal)
        {
            modal.classList.add('show');
        }

         // phương thức đóng modal
        function closeModal(modal)
        {
            modal.classList.remove('show');
        }
    </script>
    @endpush

    