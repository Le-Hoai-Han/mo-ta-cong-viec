{{-- resources/views/front/vitri/show/_huong_dan_cong_viec.blade.php --}}

<div class="huong-dan-container" style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h3 style="font-size: 20px; color: #333;">Hướng dẫn công việc</h3>

        {{-- Nút "Chỉnh sửa" này chỉ hiển thị khi người dùng có quyền, sử dụng biến $kiemTra bạn đã định nghĩa --}}
        @if ($kiemTraCaNhan)
            <a id="openEditModalBtn" style="background-color: #B52227; color: white; padding: 8px 15px; border-radius: 5px; text-decoration: none;">
                Chỉnh sửa
            </a>
        @endif
    </div>

    {{-- Khu vực hiển thị nội dung hướng dẫn công việc --}}
    <div class="huong-dan-content" style="background: #fafafa; padding: 15px; border-radius: 5px; min-height: 100px;">
        {{-- Dùng {!! !!} để render HTML từ trình soạn thảo.
             Nếu chưa có dữ liệu, hiển thị thông báo. --}}
        {!! $viTri->huong_dan_cong_viec ?? '<p><em>Chưa có hướng dẫn công việc cho vị trí này.</em></p>' !!}
    </div>
</div>
{{-- Modal để chỉnh sửa hướng dẫn công việc --}}
@if ($kiemTraCaNhan)
<div id="editHuongDanModal" class="modal">
    <div class="modal-content" style="width: 80%; max-width: 80%;">
        <span class="close" id="closeModalBtn">&times;</span>
        <h3 style="margin-bottom: 20px; font-size: 20px;">Chỉnh sửa Hướng dẫn công việc</h3>

        <form id="huongDanForm" action="{{ route('vitri.update.huongdan', $viTri->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Trình soạn thảo TinyMCE sẽ được gắn vào textarea này --}}
            <textarea id="huongDanEditor" name="huong_dan_cong_viec" style="visibility: hidden;">
                {{ $viTri->huong_dan_cong_viec }}
            </textarea>

            <div style="text-align: right; margin-top: 20px;">
                <button type="submit" style="background-color: #B52227; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Lưu thay đổi
                </button>
            </div>
        </form>
    </div>
</div>

@endif
