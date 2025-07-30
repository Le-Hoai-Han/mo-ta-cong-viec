<x-front-layout>
    @push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        a{
            cursor: pointer;
        }
        body {
            font-family: "Quicksand", Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            font-size: 24px;
            color: #B52227;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            border-radius: 5px;
            overflow: hidden;
            table-layout: fixed;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }
        th {
            background: #B52227;
            color: white;
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            /* display: flex; */
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background: #fff;
            padding: 20px;
            width: 50%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .close {
            float: right;
            font-size: 24px;
            cursor: pointer;
        }

        .show{
            display: flex !important;
        }

    </style>
    @endpush

    @php
        $kiemTra = auth()->user()->hasRole('Admin') ||
            (auth()->user()->hasRole('mo_ta_cong_viec') &&
                auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv');

        $kiemTraCaNhan = auth()->user()->hasRole('Admin') ||
            (auth()->user()->hasRole('mo_ta_cong_viec') &&
                auth()->user()->isCapTren($viTri)) || auth()->user()->hasPermissionTo('edit_mtcv') || auth()->user()->id === $viTri->id_user;
    @endphp
    <div class="container">
        <h2>{{ $viTri->ten_vi_tri }}</h2>

        @include('front.vitri.show._thong_tin_nhan_vien', [ 'nhanVien' => $viTri->user ])
        @include('front.vitri.show._mo_ta_vi_tri', [ 'viTri' => $viTri, 'listPhongBan' => $listPhongBan ])
        @include('front.vitri.show._so_do_vi_tri', [ 'viTri' => $viTri ])
        @include('front.vitri.show._trach_nhiem', [ 'viTri' => $viTri ])
        @include('front.vitri.show._huong_dan_ca_nhan', [ 'viTri' => $viTri ])
        @include('front.vitri.show._quyen_han', [ 'viTri' => $viTri ])
        @include('front.vitri.show._quan_he', [ 'viTri' => $viTri ])
        @include('front.vitri.show._tieu_chi', [ 'viTri' => $viTri ])
        @include('front.vitri.show._ask', [ 'viTri' => $viTri ])
    </div>

    @push('scripts')
    <script>
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
        function editTask(element, id) {
            if (element.querySelector("textarea") || element.querySelector("select")) return;

            let sttElement = element.querySelector('.stt');
            let sttText = sttElement ? sttElement.innerText.trim() : '';
            let currentText = element.innerText.trim().replace(sttText, '').trim();

            let action = element.getAttribute('data-action');
            let routeUpdate = getUpdateRoute(action, id);

            let fillable = element.getAttribute('data-fillable');

            element.innerHTML = '';
            if (sttElement) element.appendChild(sttElement);

            if (fillable === 'phong_ban') {
                createSelectField(element, id, sttText, routeUpdate, @json($listPhongBan), 'id', 'name');
            } else if (fillable === 'gioi_tinh') {
                createSelectField(element, id, sttText, routeUpdate, [{ id: 0, name: 'Nam' }, { id: 1, name: 'Nữ' }], 'id', 'name');
            } else if (fillable === 'id_vi_tri_quan_ly') {
                createSelectField(element, id, sttText, routeUpdate, @json($listViTri), 'id', 'ten_vi_tri');
            } else {
                createTextareaField(element, id, sttText, routeUpdate, currentText);
            }
        }

        function getUpdateRoute(action, id) {
            const routes = {
                'updateTrachNhiem': `{{ url('front-nhiem-vu') }}/${id}/update`,
                'updateMoTa': `{{ url('front-mo-ta-nhiem-vu') }}/${id}/update?field=chi_tiet`,
                'updateMoTaKetQua': `{{ url('front-mo-ta-nhiem-vu') }}/${id}/update?field=ket_qua`,
                'updateQuyenHan': `{{ url('front-tham-quyen') }}/${id}/update`,
                'updateQuanHe': `{{ url('front-quan-he') }}/${id}/update`,
                'updateASK': `{{ url('front-ask') }}/${id}/update`,
                'updateViTri': `{{ url('front-vi-tri') }}/${id}/update`,
                'updateTieuChuan': `{{ url('front-tieu-chuan') }}/${id}/update`,
                'updateHuongDan': `{{ url('front-huong-dan') }}/${id}/update`,
                'updateMoTaHuongDanChiTiet': `{{ url('front-mo-ta-huong-dan') }}/${id}/update?field=chi_tiet`,
                'updateMoTaHuongDanKetQua': `{{ url('front-mo-ta-huong-dan') }}/${id}/update?field=ket_qua`,
            };
            return routes[action] || '';
        }

        function createSelectField(element, id, sttText, routeUpdate, options, valueKey, textKey) {
            let select = document.createElement('select');
            let dataID = element.getAttribute('data-id'); // Lấy giá trị data-id từ element

            options.forEach(option => {
                let opt = new Option(option[textKey], option[valueKey]);
                if (option[valueKey].toString() === dataID) { // So sánh value của option với dataID
                    opt.selected = true; // Chọn mặc định
                }
                select.appendChild(opt);
            });

            select.addEventListener('change', () => select.blur());
            select.addEventListener('blur', () => {
                let selectedText = select.options[select.selectedIndex].textContent;
                let selectedValue = select.value;

                updateTask(id, selectedValue, element, routeUpdate, sttText, selectedText);
                element.setAttribute('data-id', selectedValue); // Cập nhật data-id
            });

            element.appendChild(select);
            select.focus();
        }




        function createTextareaField(element, id, sttText, routeUpdate, currentText) {
            let textarea = document.createElement('textarea');
            textarea.value = currentText;
            textarea.classList.add('edit-textarea');
            textarea.style.width = element?.getAttribute('data-action') === "updateTrachNhiem" || element?.getAttribute('data-action') === "updateHuongDan"  ? '500px' : '100%'
            textarea.style.minHeight = '50px';
            textarea.style.height = textarea.scrollHeight + 'px';

            textarea.addEventListener('input', () => {
                requestAnimationFrame(() => {
                    textarea.style.height = 'auto';
                    textarea.style.height = textarea.scrollHeight + 'px';
                });
            });

            textarea.onblur = () => {
                let newValue = textarea.value.trim();
                if (newValue !== currentText) {
                    updateTask(id, newValue, element, routeUpdate, sttText);
                } else {
                    resetContent(element, sttText, currentText);
                }
            };

            textarea.onkeydown = (event) => {
                if (event.key === 'Enter' && !event.shiftKey) {
                    event.preventDefault();
                    textarea.blur();
                }
            };
            element.appendChild(textarea);
            textarea.focus();
        }

        function resetContent(element, sttText, text) {
            element.innerHTML = '';
            let sttElement = document.createElement('span');
            sttElement.classList.add('stt');
            sttElement.innerText = sttText;
            element.appendChild(sttElement);
            element.appendChild(document.createTextNode(' ' + text));
        }

        function updateTask(id, newValue, element, routeUpdate, sttText, nameOption = null) {
            let fillable = element.getAttribute('data-fillable') || '';
            fetch(routeUpdate, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ value: newValue, fillable })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    element.innerHTML = '';
                    let sttElement = document.createElement('span');
                    sttElement.classList.add('stt');
                    sttElement.innerText = sttText;
                    element.appendChild(sttElement);
                    let valueElement = document.createElement('span');
                        valueElement.id = fillable; // Thêm ID vào phần tử này
                        valueElement.innerText = ' ' + (nameOption ?? newValue);
                        element.appendChild(valueElement);
                    if (fillable === "ten_vi_tri" || fillable === "id_vi_tri_quan_ly" || fillable.includes("ten_nhiem_vu")) {
                        document.querySelectorAll(`#${fillable}`).forEach(el => {
                            el.innerText = nameOption ?? newValue;
                        });
                    }
                } else {
                    alert("Cập nhật thất bại!");
                }
            })
            .catch(error => console.error("Lỗi cập nhật:", error));
        }

    </script>
    @endpush
</x-front-layout>
