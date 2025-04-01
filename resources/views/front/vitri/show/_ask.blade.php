@push('styles')
    <style>
    .ask-table th,
    .ask-table td
    {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
        position: relative;
        word-wrap: break-word;
        width: 0;
    }
    .ask-table .action-delete
    {
        position: absolute;
        right: 5px;
        top: 3px;
        cursor: pointer;
    }

    </style>
@endpush
<div class="ask">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de">
        <b>8. ASK (Attitude - Skill - Knowledge)</b>
        @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv'))
            <a onclick="addASKInput({{ $viTri->id }})" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" id-vi-tri="{{$viTri->id}}">
                <span class="material-icons">
                    add_circle_outline
                </span>
            </a>
        @endif
    </p>
        <table class="table-dat-biet">
        <thead>
            <tr>
                <th>Attitude (Thái độ)</th>
                <th>Skill (Kỹ năng)</th>
                <th>Knowledge (Kiến thức)</th>
            </tr>
        </thead>
        <tbody>

            <tr>
                @foreach([0 => 'Thái độ', 1 => 'Kỹ năng',2 => 'Kiến thức'] as $loai => $title)
                <td>
                    <table class="ask-table" data-loai="{{ $loai }}">
                        @foreach($viTri->ASK->where('loai',$loai) as $item)
                            <tr>
                                <td>
                                    <div data-action="updateASK" ondblclick="editTask(this, {{$item->id}})">
                                        {{$item->noi_dung}}
                                    </div>
                                    @if(auth()->user()->hasRole('Admin') || (auth()->user()->hasRole('mo_ta_cong_viec') && auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv'))
                                    <div class="action-delete">
                                        <a onclick="xacNhanYeuCauXoaASK(this,{{ $item->id }})" style="<?php echo ($viTri->trang_thai != 0 ? 'display:none' :'') ?>" data-name="{{ $title }}">
                                            <span class="material-icons delete">
                                                delete
                                            </span>
                                        </a>
                                    </div>

                                </td>
                                @endif
                            </li>
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
      function addASKInput(idViTri) {
        const tables = document.querySelectorAll(".ask-table");
        tables.forEach(table => {
            let loai = table.dataset.loai;
            let tr = document.createElement("tr");
            tr.innerHTML = `<td>
                <input type="text" id="${loai == 0 ? 'input-thai-do-' : (loai == 1 ? 'input-ky-nang-' : 'input-kien-thuc-')}${idViTri}" class="edit-textarea" placeholder="Nhập ${loai == 0 ? 'thái độ' : (loai == 1 ? 'kỹ năng' : 'kiến thức')}..." data-vi-tri="${idViTri}" data-loai="${loai}">
            </td>`;

            table.appendChild(tr);
            tr.querySelector("input").focus();
        });

        let inputThaiDo = document.getElementById(`input-thai-do-${idViTri}`);
        let inputKyNang = document.getElementById(`input-ky-nang-${idViTri}`);
        let inputKienThuc = document.getElementById(`input-kien-thuc-${idViTri}`);

        [inputThaiDo, inputKyNang, inputKienThuc].forEach(input => {
            input.addEventListener("keydown", function (event) {
                if (event.key === "Enter" && !event.shiftKey) {
                    event.preventDefault();
                    saveASK(idViTri, inputThaiDo.value.trim(), inputKyNang.value.trim(), inputKienThuc.value.trim());
                }
            });
        });
    }

    function saveASK(idViTri,thaiDo,kyNang,kienThuc) {

        if (thaiDo === "" && kyNang === "" && kienThuc === "") {
            alert("Vui lòng nhập đủ thông tin!");
            return;
        }

        fetch("{{ route('front-ask.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector("meta[name='csrf-token']").content
            },
            body: JSON.stringify({ id_vi_tri: idViTri, thai_do: thaiDo,ky_nang: kyNang,kien_thuc : kienThuc })
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


    function xacNhanYeuCauXoaASK(element,id)
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
                xoaASK(element,id)
            }
        });
    }

    function xoaASK(element,id){
            $.ajax({
                url:"{{url('front-ask-delete')}}/"+id,
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
</script>
@endpush
