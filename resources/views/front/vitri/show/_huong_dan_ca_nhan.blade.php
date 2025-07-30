@push('styles')
<style>
    .personal-editable-section {
        background-color: #f9fafb;
        border-left: 4px solid #3b82f6;
        padding: 20px;
        margin-top: 15px;
        position: relative;
    }

    /* [THÊM MỚI] - Dòng chữ ghi chú nhỏ */
    .personal-editable-section .edit-hint {
        font-size: 0.875rem; /* 14px */
        color: #6b7280; /* Màu xám */
        margin-bottom: 15px;
        display: block;
    }

    /* Các style cũ của bạn */
    .trach-nhiem-title {
        color: #B52227;
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .trach-nhiem-title .title{
        position: relative;
        padding:0px 20px;
    }

    .trach-nhiem-title .title .action-delete
    {
        position: absolute;
        right: 0;
        top: 0;
        cursor: pointer;
    }
    .trach-nhiem-title a {
        margin-left: 10px;
    }
    .nhiem-vu-item {
        border-left: 4px solid #B52227;
        padding-left: 10px;
        margin-bottom: 5px;
        cursor: pointer;
    }
    .trach-nhiem-table {
        width: 100%;
        border-collapse: collapse;
    }
    .trach-nhiem-table th,
    .trach-nhiem-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        position: relative;
        table-layout: fixed;
        word-wrap: break-word;
        width: 50%;
    }
    .trach-nhiem-table th {
        background-color: #B52227;
        color: white;
        font-weight: bold;
    }

    .trach-nhiem-table .action-delete
    {
        position: absolute;
        right: 5px;
        top: 3px;
        cursor: pointer;
    }
    .edit-textarea {
        width: 100%;
        min-width: 100%;
        max-width: 100%;
        min-height: 50px;
        border: none;
        background: none;
        font-size: 16px;
        font-weight: bold;
        padding: 5px;
        resize: none;
        overflow: hidden;
    }
    .material-icons{
        font-size: 18px;
    }
    .material-icons.delete{
        color: red !important;
    }

</style>
@endpush

<!-- [SỬA ĐỔI] - Bọc toàn bộ phần này trong một div cha với class mới -->
<div class="@if($kiemTraCaNhan) personal-editable-section @endif" id="huong-dan-cong-viec">

    <p class="so-do-to-chuc_tieu_de">
        <b>5. Hướng dẫn công việc</b>
    </p>

    {{-- [THÊM MỚI] - Thêm một dòng ghi chú chỉ hiển thị khi có quyền sửa --}}
    @if($kiemTraCaNhan)
        <span class="edit-hint">
            Lưu ý: Bạn có thể thêm, xóa, hoặc nhấn đúp chuột để chỉnh sửa nội dung trong phần này.
        </span>
    @endif

    <div class="trach-nhiem-nhiem-vu">
        <table class="trach-nhiem-table">
            <thead>
                <tr>
                    <th>Trách nhiệm và nhiệm vụ chính</th>
                    <th>Kết quả đầu ra</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                @foreach ($viTri->huongDanCaNhan as $huongDanCaNhan)
                    <tr id="trach-nhiem-{{ $i }}">
                        <td colspan="2">
                            <div class="trach-nhiem-title">
                                <div class="title">
                                    @if($kiemTraCaNhan)
                                    <div class="action-delete">
                                        <a onclick="xacNhanYeuCauXoaHuongDan('{{ $huongDanCaNhan->id }}')" style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                            <span title="Xóa hướng dẫn" class="material-icons delete">delete</span>
                                        </a>
                                    </div>
                                    @endif
                                    @if($kiemTraCaNhan)
                                        <span title="Nhấn đúp vào để chỉnh sửa nội dung" class="editable" data-fillable="ten_huong_dan_{{ $huongDanCaNhan->id }}" data-action="updateHuongDan" ondblclick="editTask(this, '{{ $huongDanCaNhan->id }}')">
                                            <span class="stt">{{ $i++ }}.</span> {{ $huongDanCaNhan->ten_huong_dan }}
                                        </span>
                                    @else
                                        <span class="editable" data-fillable="ten_huong_dan_{{ $huongDanCaNhan->id }}" data-action="updateHuongDan">
                                            <span class="stt">{{ $i++ }}.</span> {{ $huongDanCaNhan->ten_huong_dan }}
                                        </span>
                                    @endif
                                </div>
                                @if ($kiemTraCaNhan)
                                    <a class="edit-action" onclick="addMoTaHuongDanInput(this, '{{ $huongDanCaNhan->id }}')" title="Thêm mô tả">
                                        <span class="material-icons">add_circle_outline</span>
                                    </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @foreach ($huongDanCaNhan->moTaHuongDan as $moTa)
                        <tr>
                            @if($kiemTraCaNhan)
                            <td class="nhiem-vu-item editable" title="Nhấn đúp vào để chỉnh sửa nội dung" data-action="updateMoTaHuongDanChiTiet" ondblclick="editTask(this, '{{ $moTa->id }}')">
                                {{ $moTa->chi_tiet }}
                            </td>
                            <td>
                                <div class="editable" title="Nhấn đúp vào để chỉnh sửa nội dung" data-action="updateMoTaHuongDanKetQua" ondblclick="editTask(this, '{{ $moTa->id }}')">
                                    {{ $moTa->ket_qua }}

                                </div>
                                <div class="action-delete">
                                    <a onclick="xacNhanYeuCauXoaMoTaHuongDan('{{ $moTa->id }}')" id="delete-trach-nhiem" style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                        <span title="Xóa nhiệm vụ" class="material-icons delete">delete</span>
                                    </a>
                                </div>
                            </td>
                            @else
                            <td class="nhiem-vu-item editable" data-action="updateMoTa">
                                {{ $moTa->chi_tiet }}
                            </td>
                            <td>
                                <div class="editable" data-action="updateMoTaKetQua">
                                    {{ $moTa->ket_qua }}

                                </div>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                @endforeach
                @if ($kiemTraCaNhan)
                <tr id="add-trach-nhiem-row">
                    <td colspan="2">
                        <input type="text" id="new-huong-dan" data-id-vi-tri="{{ $viTri->id }}" class="edit-textarea" placeholder="Nhập trách nhiệm và ấn Enter..." onkeydown="handleAddHuongDan(this,event)">
                    </td>
                </tr>
                @endif

            </tbody>
        </table>
    </div>
</div>

@push('scripts')
{{-- JavaScript của bạn không thay đổi --}}
<script>
    // ... Toàn bộ các hàm JavaScript của bạn giữ nguyên ...
</script>
@endpush
