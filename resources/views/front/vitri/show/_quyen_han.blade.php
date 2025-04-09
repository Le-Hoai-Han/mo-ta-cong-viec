@push('styles')
<style>
    .tham-quyen-table th,
    .tham-quyen-table td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        position: relative;
    }
    .tham-quyen-table .action-delete {
        position: absolute;
        right: 5px;
        top: 3px;
        cursor: pointer;
    }
</style>
@endpush

<div class="tham-quyen">
    <p class="so-do-to-chuc_tieu_de"><b>5. Thẩm quyền/Quyền hạn</b>
        @if($kiemTra)
        <a style="display: {{ $viTri->trang_thai != 0 ? 'none' : 'inline' }}" onclick="addThamQuyenInput({{ $viTri->id }})">
            <span class="material-icons">add_circle_outline</span>
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
                @foreach([1 => 'Đề xuất', 2 => 'Ra quyết định'] as $loai => $title)
                <td>
                    <table class="tham-quyen-table" data-loai="{{ $loai }}">
                        @foreach($viTri->thamQuyen->where('loai', $loai) as $thamQuyen)
                        <tr>
                            <td>
                            @if($kiemTra)
                                <div data-action="updateQuyenHan" ondblclick="editTask(this, {{ $thamQuyen->id }})">
                                    <span class="tham-quyen-text">{{ $thamQuyen->noi_dung }}</span>
                                </div>
                                <div class="action-delete">
                                    <a onclick="xacNhanYeuCauXoaThamQuyen(this,{{ $thamQuyen->id }})" class="btn-delete-tham-quyen" data-name="{{ $title }}" style="display: {{ $viTri->trang_thai != 0 ? 'none' : 'inline' }}">
                                        <span class="material-icons delete" style="font-size: 18px; color: red">delete</span>
                                    </a>
                                </div>
                            @else
                                <div data-action="updateQuyenHan">
                                    <span class="tham-quyen-text">{{ $thamQuyen->noi_dung }}</span>
                                </div>
                            @endif
                               
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>

@push('scripts')
<script>
    function addThamQuyenInput(idViTri) {
        const tables = document.querySelectorAll(".tham-quyen-table");
        tables.forEach(table => {
            let loai = table.dataset.loai;
            let tr = document.createElement("tr");
            tr.innerHTML = `<td>
                <input type="text" id="${loai == 1 ? 'input-de-xuat-' : 'input-ra-quyet-dinh-'}${idViTri}" class="edit-textarea" placeholder="Nhập ${loai == 1 ? 'đề xuất' : 'ra quyết định'}..." data-vi-tri="${idViTri}" data-loai="${loai}">
            </td>`;

            table.appendChild(tr);
            tr.querySelector("input").focus();
        });

        let inputDeXuat = document.getElementById(`input-de-xuat-${idViTri}`);
        let inputRaQuyetDinh = document.getElementById(`input-ra-quyet-dinh-${idViTri}`);
        [inputDeXuat,inputRaQuyetDinh].forEach(input=>{
            input.addEventListener("keydown", function (event) {
            if (event.key === "Enter" && !event.shiftKey) {
                event.preventDefault();
                saveThamQuyen(idViTri, inputDeXuat.value.trim(), inputRaQuyetDinh.value.trim());
            }
        });

        })
    }


    function saveThamQuyen(idViTri,deXuat,raQuyetDinh) {

        if (deXuat === "" && raQuyetDinh === "") {
            alert("Vui lòng nhập đủ thông tin!");
            return;
        }

        fetch("{{ route('front-tham-quyen.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
            },
            body: JSON.stringify({ id_vi_tri: idViTri, de_xuat: deXuat,ra_quyet_dinh: raQuyetDinh })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                hienThongBao('Thêm thành công');
                    setTimeout(function() {
                            location.reload();
                        }, 500);
            } else {
                alert("Thêm thất bại!");
            }
        })
        .catch(error => {
            console.error("Lỗi:", error);
        });
    }

    function xoaThamQuyen(element,id){
            $.ajax({
                url:"{{url('front-tham-quyen-delete')}}/"+id,
                type:'delete',
                dataType:'json',
                data:{
                    _token:'{{csrf_token()}}',
                    id:id,
                },
                success:function(res){
                    if(res.status == 'success'){
                        hienThongBao(`Xóa ${element.getAttribute('data-name')} thành công`);
                        setTimeout(function() {
                                location.reload();
                            }, 500);
                    }else{
                        hienLoi('Xóa thất bại')
                    }
                }
            })
        }

    function xacNhanYeuCauXoaThamQuyen(element,id)
    {
        Swal.fire({
            title: "Xác nhận",
            text: `Bạn có chắc chắn muốn xóa ${element.getAttribute('data-name')} này`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Xác nhận',
            confirmButtonColor: "#B52227",
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                xoaThamQuyen(element,id)
            }
        });
    }
</script>
@endpush
