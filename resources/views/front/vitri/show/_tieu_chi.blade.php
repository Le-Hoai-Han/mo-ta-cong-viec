
    {{-- Model add --}}
    @push('styles')
    <style>
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            /* display: flex; */
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 20px;
            position: relative;
        }
        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #555;
        }
        .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }
    .form-group {
        display: flex;
        flex-direction: column;
    }
    .button-group {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 15px;
    }
    .form-buttons {
    display: flex;
    justify-content: flex-end;
    gap: 10px; /* Khoảng cách giữa hai nút */
}

    .button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.1s;
    }

    /* Nút chính */
    .button-primary {
        background-color: #B52227;
        color: white;
    }

    .button-primary:hover {
        background-color: #d12a30;
    }

    .button-primary:active {
        background-color: #901b1f;
        transform: scale(0.98);
    }

    /* Nút phụ */
    .button-secondary {
        background-color: #888888;
        color: white;
    }

    .button-secondary:hover {
        background-color: #9e9e9e;
    }

    .button-secondary:active {
        background-color: #6e6e6e;
        transform: scale(0.98);
    }

    </style>
    @endpush
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
                    <td>
                        <div data-action="updateTieuChuan" data-id="{{ $tieuChi->gioi_tinh == 0 ? 0:1 }}" data-fillable="gioi_tinh" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->gioi_tinh == 0 ? 'Nam' :'Nữ'}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Độ tuổi</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="do_tuoi" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->tuoi}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Học vấn</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="hoc_van" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->hoc_van}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Chuyên môn</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="chuyen_mon" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->chuyen_mon}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Vi tính</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="vi_tinh" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->vi_tinh}}</p>
                        </div>
                    </td>
                </tr>
                </tr>
                <tr>
                    <td>Anh ngữ</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="anh_ngu" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->anh_ngu}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Kinh nghiệm</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="kinh_nghiem" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->kinh_nghiem}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Kỹ năng cần có</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="ky_nang" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->ky_nang}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Thái độ/tố chất cần có</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="to_chat" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->to_chat}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Ngoại hình</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="ngoai_hinh" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->ngoai_hinh}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Sức khỏe</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="suc_khoe" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->suc_khoe}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Nơi ở</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="ho_khau" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->ho_khau}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Ưu tiên</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="uu_tien" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->uu_tien}}</p>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Khác</td>
                    <td>
                        <div data-action="updateTieuChuan" data-fillable="khac" ondblclick="editTask(this, {{$tieuChi->id}})">
                            <p>{{$tieuChi->khac ?? '...'}}</p>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
</div>

<div id="modal_add_tieu_chuan" class="modal-overlay">
    <div class="modal-content">
        <button id="close-add-tieu-chuan" class="close-button">&times;</button>
        <h3 class="form-label">Tiêu chuẩn</h3>
        <form id="form-add-tieu-chuan">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label for="id_vi_tri" class="form-label">Vị trí</label>
                    <select name="id_vi_tri" class="form-control" disabled>
                        <option value="{{ $viTri->id }}" id="option_vi_tri">{{ $viTri->ten_vi_tri }}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="gioi_tinh" class="form-label">Giới tính</label>
                    <select name="gioi_tinh" class="form-control" id="option_add_gioi_tinh">
                        <option value="Nam">Nam</option>
                        <option value="Nữ">Nữ</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tuoi" class="form-label">Độ tuổi</label>
                        <input type="text" name="tuoi" class="form-control" id="option_add_do_tuoi" placeholder="Độ tuổi" value="{!! old('tuoi', '') !!}">
                    </div>
                <div class="form-group">
                    <label for="hoc_van" class="form-label">Học vấn</label>
                    <input type="text" name="hoc_van" class="form-control" id="option_add_hoc_van" placeholder="Học vấn" value="{!! old('hoc_van', '') !!}">
                </div>
                <div class="form-group">
                    <label for="chuyen_mon" class="form-label">Chuyên môn</label>
                    <input type="text" name="chuyen_mon" class="form-control" id="option_add_chuyen_mon" placeholder="Chuyên môn" value="{!! old('chuyen_mon', '') !!}">
                </div>
                <div class="form-group">
                    <label for="vi_tinh" class="form-label">Tin học</label>
                    <input type="text" name="vi_tinh" class="form-control" id="option_add_vi_tinh" placeholder="Tin học" value="{!! old('vi_tinh', '') !!}">
                </div>
                <div class="form-group">
                    <label for="anh_ngu" class="form-label">Anh ngữ</label>
                    <input type="text" name="anh_ngu" class="form-control" id="option_add_anh_ngu" placeholder="Anh ngữ" value="{!! old('anh_ngu', '') !!}">
                </div>
                <div class="form-group">
                    <label for="kinh_nghiem" class="form-label">Kinh nghiệm</label>
                    <input type="text" name="kinh_nghiem" class="form-control" id="option_add_kinh_nghiem" placeholder="Kinh nghiệm" value="{!! old('kinh_nghiem', '') !!}">
                </div>
                <div class="form-group">
                    <label for="ky_nang" class="form-label">Kỹ năng</label>
                    <input type="text" name="ky_nang" class="form-control" id="option_add_ky_nang" placeholder="Kỹ năng" value="{!! old('ky_nang', '') !!}">
                </div>
                <div class="form-group">
                    <label for="to_chat" class="form-label">Tố chất</label>
                    <input type="text" name="to_chat" class="form-control" id="option_add_to_chat" placeholder="Tố chất" value="{!! old('to_chat', '') !!}">
                </div>
                <div class="form-group">
                    <label for="ngoai_hinh" class="form-label">Ngoại hình</label>
                    <input type="text" name="ngoai_hinh" class="form-control" id="option_add_ngoai_hinh" placeholder="Ngoại hình" value="{!! old('ngoai_hinh', '') !!}">
                </div>
                <div class="form-group">
                    <label for="suc_khoe" class="form-label">Sức khỏe</label>
                    <input type="text" name="suc_khoe" class="form-control" id="option_add_suc_khoe" placeholder="Sức khỏe" value="{!! old('suc_khoe', '') !!}">
                </div>
                <div class="form-group">
                    <label for="noi_o" class="form-label">Nơi ở</label>
                    <input type="text" name="noi_o" class="form-control" id="option_add_noi_o" placeholder="Nơi ở" value="{!! old('noi_o', '') !!}">
                </div>
                <div class="form-group">
                    <label for="uu_tien" class="form-label">Ưu tiên</label>
                    <input type="text" name="uu_tien" class="form-control" id="option_add_uu_tien" placeholder="Ưu tiên" value="{!! old('uu_tien', '') !!}">
                </div>
                <div class="form-group">
                    <label for="khac" class="form-label">Khác</label>
                    <input type="text" name="khac" class="form-control" id="option_add_khac" placeholder="Khác" value="{!! old('khac', '') !!}">
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="button button-primary">Lưu</button>
                <button type="button" id="cancel-modal" class="button button-secondary">Hủy</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
     var btnAddTieuChuan = document.getElementById('btn_add_tieu_chuan');
     var modalAddTieuChuan = document.getElementById('modal_add_tieu_chuan');
     var formAddTieuChuan = document.getElementById('form-add-tieu-chuan');

     if(btnAddTieuChuan != null){
            btnAddTieuChuan.onclick = function() {
                openModal(modalAddTieuChuan);
                idViTri = this.getAttribute('id-vi-tri');
            }
        }
        document.getElementById('form-add-tieu-chuan').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn reload trang

            var formData = {
                _token: "{{ csrf_token() }}",
                id_vi_tri: document.getElementById('option_vi_tri').value,
                gioi_tinh: document.getElementById('option_add_gioi_tinh').value,
                tuoi: document.getElementById('option_add_do_tuoi').value,
                hoc_van: document.getElementById('option_add_hoc_van').value,
                chuyen_mon: document.getElementById('option_add_chuyen_mon').value,
                kinh_nghiem: document.getElementById('option_add_kinh_nghiem').value,
                vi_tinh: document.getElementById('option_add_vi_tinh').value,
                anh_ngu: document.getElementById('option_add_anh_ngu').value,
                ky_nang: document.getElementById('option_add_ky_nang').value,
                to_chat: document.getElementById('option_add_to_chat').value,
                ho_khau: document.getElementById('option_add_noi_o').value,
                ngoai_hinh: document.getElementById('option_add_ngoai_hinh').value,
                uu_tien: document.getElementById('option_add_uu_tien').value,
                khac: document.getElementById('option_add_khac').value,
                suc_khoe: document.getElementById('option_add_suc_khoe').value
            };

            var routeStore = "{{ url('/front-tieu-chuan/store') }}";

            $.ajax({
                url: routeStore,
                type: 'POST',
                dataType: 'json',
                data: formData,
                success: function(response) {
                    hienThongBao(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 500);
                },
                error: function(xhr) {
                    const error = JSON.parse(xhr.responseText);
                    if (error.errors) {
                    for (const key in error.errors) {
                        if (error.errors[key].length > 0) {
                            hienLoi(error.errors[key][0]);
                            break; // Hiển thị lỗi đầu tiên rồi dừng lại
                        }
                    }
                }
                }
            });
        });


</script>
@endpush
