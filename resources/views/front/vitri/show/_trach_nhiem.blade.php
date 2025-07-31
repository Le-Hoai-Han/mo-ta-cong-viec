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
    <b>{{ $sectionNumber }}. Các trách nhiệm và nhiệm vụ chính</b>
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
            @foreach ($viTri->nhiemVu as $nhiemVu)
                <tr id="trach-nhiem-{{ $i }}">
                    <td colspan="2">
                        <div class="trach-nhiem-title">
                            <div class="title">
                                @if($kiemTra)
                                <div class="action-delete">
                                    <a onclick="xacNhanYeuCauXoaTrachNhiem('{{ $nhiemVu->id }}')" style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
                                        <span title="Xóa nhiệm vụ" class="material-icons delete">delete</span>
                                    </a>
                                </div>
                                @endif
                                @if($kiemTra)
                                    <span class="editable" data-fillable="ten_nhiem_vu_{{ $nhiemVu->id }}" data-action="updateTrachNhiem" ondblclick="editTask(this, '{{ $nhiemVu->id }}')" title="Nhấp đúp để chỉnh sửa">
                                        <span class="stt">{{ $i++ }}.</span> {{ $nhiemVu->ten_nhiem_vu }}
                                    </span>
                                @else
                                    <span class="editable" data-fillable="ten_nhiem_vu_{{ $nhiemVu->id }}" data-action="updateTrachNhiem">
                                        <span class="stt">{{ $i++ }}.</span> {{ $nhiemVu->ten_nhiem_vu }}
                                    </span>
                                @endif
                            </div>
                            @if ($kiemTra)
                                <a class="edit-action" onclick="addMoTaInput(this, '{{ $nhiemVu->id }}')" title="Thêm mô tả nhiệm vụ">
                                    <span class="material-icons">add_circle_outline</span>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
                @foreach ($nhiemVu->moTaNhiemVu as $moTa)
                    <tr>
                        @if($kiemTra)
                        <td class="nhiem-vu-item editable" data-action="updateMoTa" ondblclick="editTask(this, '{{ $moTa->id }}')" title="Nhấp đúp để chỉnh sửa">
                            {{ $moTa->chi_tiet }}
                        </td>
                        <td>
                            <div class="editable" data-action="updateMoTaKetQua" ondblclick="editTask(this, '{{ $moTa->id }}')" title="Nhấp đúp để chỉnh sửa">
                                {{ $moTa->ket_qua }}

                            </div>
                            <div class="action-delete">
                                <a onclick="xacNhanYeuCauXoaNhiemVu('{{ $moTa->id }}')" id="delete-trach-nhiem" style="<?php echo $viTri->trang_thai != 0 ? 'display:none' : ''; ?>">
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
            @if ($kiemTra)
            <tr id="add-trach-nhiem-row">
                <td colspan="2">
                    <input type="text" id="new-trach-nhiem" data-id-vi-tri="{{ $viTri->id }}" class="edit-textarea" placeholder="Nhập trách nhiệm mới và ấn Enter..." onkeydown="handleAddTrachNhiem(this,event)">
                </td>
            </tr>
            @endif

        </tbody>
    </table>
</div>
@push('scripts')
<script>

function handleAddTrachNhiem(element,event) {
    if (event.key === "Enter" && !event.shiftKey) {
        event.preventDefault();
        let input = document.getElementById("new-trach-nhiem");
        let newValue = input.value.trim();
        let idViTri = element.getAttribute('data-id-vi-tri')

        if (newValue === "") return;

        routeUpdate = "{{route('front-nhiem-vu.store')}}";
        fetch(routeUpdate, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
            },
            body: JSON.stringify({ ten_nhiem_vu: newValue,id_vi_tri:idViTri })
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

function addMoTaInput(element, idNhiemVu) {
    let tr = document.createElement("tr");

    tr.innerHTML = `
        <td>
            <input type="text" class="edit-textarea" placeholder="Nhập chi tiết..." id="input-chi-tiet-${idNhiemVu}">
        </td>
        <td>
            <input type="text" class="edit-textarea" placeholder="Nhập kết quả và ấn Enter..." id="input-ket-qua-${idNhiemVu}">
        </td>
    `;

    let parentRow = element.closest("tr");
    parentRow.insertAdjacentElement("afterend", tr);

    let inputChiTiet = document.getElementById(`input-chi-tiet-${idNhiemVu}`);
    let inputKetQua = document.getElementById(`input-ket-qua-${idNhiemVu}`);

    inputChiTiet.focus();

    [inputChiTiet,inputKetQua].forEach(input => {
        input.addEventListener("keydown", function (event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                saveMoTa(idNhiemVu, inputChiTiet.value.trim(), inputKetQua.value.trim(), tr);
            }
        });
    })
}

function saveMoTa(idNhiemVu, chiTiet, ketQua, rowElement) {
    if (chiTiet === "" || ketQua === "") {
        alert("Vui lòng nhập đủ thông tin cho chi tiết và kết quả!");
        return;
    }

    fetch("{{ route('front-mo-ta-nhiem-vu.store') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
        },
        body: JSON.stringify({ id_nhiem_vu: idNhiemVu, chi_tiet: chiTiet, ket_qua: ketQua })
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


    function xoaTrachNhiem(id){
            $.ajax({
                url:"{{url('front-nhiem-vu-delete')}}/" +id ,
                type:"delete",
                dataType:"json",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id":id,
                },
                success:function(res){
                    if(res.status == 'success'){
                        hienThongBao('Xóa trách nhiệm thành công');
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }else{
                        hienLoi('Xóa thất bại')
                    }
                }
            })
        }

        function xoaMoTaNhiemVu(id){
            $.ajax({
                url:"{{url('front-mo-ta-nhiem-vu-delete')}}/"+id,
                type:'delete',
                dataType:'json',
                data:{
                    _token:'{{csrf_token()}}',
                    id:id,
                },
                success:function(res){
                    if(res.status == 'success'){
                        hienThongBao('Xóa nhiệm vụ thành công');
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }else{
                        hienLoi('Xóa thất bại')
                    }
                }
            })
        }

        function xacNhanYeuCauXoaTrachNhiem(id)
        {
            Swal.fire({
                title: "Xác nhận",
                text: `Bạn có chắc chắn muốn xóa trách nhiệm này`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                confirmButtonColor: "#B52227",
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    xoaTrachNhiem(id)
                }
            });
        }

        function xacNhanYeuCauXoaNhiemVu(id)
        {
            Swal.fire({
                title: "Xác nhận",
                text: `Bạn có chắc chắn muốn xóa nhiệm vụ này`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Xác nhận',
                confirmButtonColor: "#B52227",
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    xoaMoTaNhiemVu(id)
                }
            });
        }
</script>
@endpush


