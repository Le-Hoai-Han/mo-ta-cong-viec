@push('styles')
<style>
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
<p class="so-do-to-chuc_tieu_de">
    <b>5. Hướng dẫn công việc <em>(Cá nhân tự điền)</em></b>
</p>
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
@push('scripts')
<script>

function handleAddHuongDan(element,event) {
    if (event.key === "Enter" && !event.shiftKey) {
        event.preventDefault();
        let input = document.getElementById("new-huong-dan");
        let newValue = input.value.trim();
        let idViTri = element.getAttribute('data-id-vi-tri')

        if (newValue === "") return;

        routeUpdate = "{{route('front-huong-dan.store')}}";
        fetch(routeUpdate, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
            },
            body: JSON.stringify({ ten_huong_dan: newValue,id_vi_tri:idViTri })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload(); // Làm mới trang để hiển thị dữ liệu mới
            } else {
                alert("Thêm trách nhiệm thất bại!");
            }
        })
        .catch(error => {
            console.error("Lỗi thêm trách nhiệm:", error);
        });
    }
}

function addMoTaHuongDanInput(element, idHuongDan) {
    let tr = document.createElement("tr");

    tr.innerHTML = `
        <td>
            <input type="text" class="edit-textarea" placeholder="Nhập chi tiết..." id="input-chi-tiet-${idHuongDan}">
        </td>
        <td>
            <input type="text" class="edit-textarea" placeholder="Nhập kết quả và ấn Enter..." id="input-ket-qua-${idHuongDan}">
        </td>
    `;

    let parentRow = element.closest("tr");
    parentRow.insertAdjacentElement("afterend", tr);

    let inputChiTiet = document.getElementById(`input-chi-tiet-${idHuongDan}`);
    let inputKetQua = document.getElementById(`input-ket-qua-${idHuongDan}`);

    inputChiTiet.focus();

    [inputChiTiet,inputKetQua].forEach(input => {
        input.addEventListener("keydown", function (event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                saveMoTaHuongDan(idHuongDan, inputChiTiet.value.trim(), inputKetQua.value.trim(), tr);
            }
        });
    })
}

function saveMoTaHuongDan(idHuongDan, chiTiet, ketQua, rowElement) {
    if (chiTiet === "" || ketQua === "") {
        alert("Vui lòng nhập đủ thông tin cho chi tiết và kết quả!");
        return;
    }

    fetch("{{ route('front-mo-ta-huong-dan.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
        },
        body: JSON.stringify({ id_huong_dan: idHuongDan, chi_tiet: chiTiet, ket_qua: ketQua })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload(); // Làm mới trang để hiển thị dữ liệu mới
        } else {
            alert("Thêm mô tả thất bại!");
        }
    })
    .catch(error => {
        console.error("Lỗi thêm mô tả:", error);
    });
}


    function xoaHuongDan(id){
            $.ajax({
                url:"{{url('front-huong-dan-delete')}}/" +id ,
                type:"delete",
                dataType:"json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id":id,
                },
                success:function(res){
                    if(res.status == 'success'){
                        hienThongBao('Xóa hướng dẫn thành công');
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }else{
                        hienLoi('Xóa thất bại')
                    }
                }
            })
        }

        function xoamoTaHuongDan(id){
            $.ajax({
                url:"{{url('front-mo-ta-huong-dan-delete')}}/"+id,
                type:'delete',
                dataType:'json',
                data:{
                    _token:'{{csrf_token()}}',
                    id:id,
                },
                success:function(res){
                    if(res.status == 'success'){
                        hienThongBao('Xóa mô tả thành công');
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }else{
                        hienLoi('Xóa thất bại')
                    }
                }
            })
        }

        function xacNhanYeuCauXoaHuongDan(id)
        {
            Swal.fire({
                title: "Xác nhận",
                text: `Bạn có chắc chắn muốn xóa hướng dẫn này`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                confirmButtonColor: "#B52227",
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    xoaHuongDan(id)
                }
            });
        }

        function xacNhanYeuCauXoaMoTaHuongDan(id)
        {
            Swal.fire({
                title: "Xác nhận",
                text: `Bạn có chắc chắn muốn xóa mô tả này`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                confirmButtonColor: "#B52227",
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    xoamoTaHuongDan(id)
                }
            });
        }
</script>
@endpush


