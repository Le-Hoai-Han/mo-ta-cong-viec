@push('styles')
    <style>

        .quan-he-table th,
        .quan-he-table td
        {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
            position: relative;
        }
        .quan-he-table .action-delete
            {
                position: absolute;
                right: 5px;
                top: 3px;
                cursor: pointer;
            }
    </style>
@endpush
<div class="quan-he">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de">
        <b>7. Quan hệ công việc</b>
        @if($kiemTra)
            <a onclick="addQuanHeInput({{ $viTri->id }})" style="cursor: pointer;<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" title="Thêm quan hệ công việc">
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
                    @foreach([0 => 'Bên Trong', 1 => 'Bên ngoài'] as $loai => $title)
                    <td>
                        <table class="quan-he-table" data-loai="{{ $loai }}">
                            @foreach($viTri->quanHe->where('loai',$loai) as $quanHe)
                                <tr>
                                    <td>
                                         @if($kiemTra)
                                        <div data-action="updateQuanHe" ondblclick="editTask(this, {{$quanHe->id}})">
                                            <span class="quan-he-text">  {{$quanHe->noi_dung}}</span>
                                        </div>
                                        <div class="action-delete">
                                            <a onclick="xacNhanYeuCauXoaQuanHe('{{ $quanHe->id }}')" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>">
                                                <span class="material-icons delete">
                                                    delete
                                                </span>
                                            </a>
                                        </div>
                                        @else
                                        <div data-action="updateQuanHe">
                                            <span class="quan-he-text">  {{$quanHe->noi_dung}}</span>
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

    function saveQuanHe(idViTri,benTrong,benNgoai) {

        if (benTrong === "" && benNgoai === "") {
            alert("Vui lòng nhập đủ thông tin!");
            return;
        }

        fetch("{{ route('front-quan-he.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
            },
            body: JSON.stringify({ id_vi_tri: idViTri, ben_trong: benTrong,ben_ngoai: benNgoai })
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
    function addQuanHeInput(idViTri) {
            const tables = document.querySelectorAll(".quan-he-table");
            tables.forEach(table => {
                let loai = table.dataset.loai;
                let tr = document.createElement("tr");
                tr.innerHTML = `<td>
                    <input type="text" id="${loai == 0 ? 'input-ben-trong-' : 'input-ben-ngoai-'}${idViTri}" class="edit-textarea" placeholder="Nhập ${loai == 0 ? 'Quan hệ bên trong' : 'Quan hệ bên ngoài'} và ấn Enter..." data-vi-tri="${idViTri}" data-loai="${loai}">
                </td>`;

                table.appendChild(tr);
                tr.querySelector("input").focus();
            });

            let inputBenTrong = document.getElementById(`input-ben-trong-${idViTri}`);
            let inputBenNgoai = document.getElementById(`input-ben-ngoai-${idViTri}`);

            [inputBenTrong, inputBenNgoai].forEach(input => {
                input.addEventListener("keydown", function (event) {
                if (event.key === "Enter" && !event.shiftKey) {
                    event.preventDefault();
                    saveQuanHe(idViTri, inputBenTrong.value.trim(), inputBenNgoai.value.trim());
                }
            });
        })
        }


    function xoaQuanHe(id){
        $.ajax({
            url:"{{url('front-quan-he-delete')}}/"+id,
            type:'delete',
            dataType:'json',
            data:{
                _token:'{{csrf_token()}}',
                id:id,
            },
            success:function(res){
                if(res.status == 'success'){
                    hienThongBao('Xóa quan hệ thành công');
                    setTimeout(function() {
                            location.reload();
                        }, 500);
                }else{
                    hienLoi('Xóa thất bại')
                }
            }
        })
    }
    function xacNhanYeuCauXoaQuanHe(id)
    {
        Swal.fire({
            title: "Xác nhận",
            text: `Bạn có chắc chắn muốn xóa quan hệ này`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Xác nhận',
            confirmButtonColor: "#B52227",
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                xoaQuanHe(id)
            }
        });
    }
    </script>
@endpush
