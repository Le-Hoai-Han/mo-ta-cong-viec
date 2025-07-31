@push('styles')
<style>
    /* ... các class cũ của bạn ... */
    .size-40 { width: 10rem; height: 10rem; }
    .rounded-full { border-radius: 9999px; }
    .overflow-hidden { overflow: hidden; }
    .w-full { width: 100%; }
    .h-full { height: 100%; }
    .object-cover { object-fit: cover; }

    /* ===== BẮT ĐẦU PHẦN TỐI ƯU ===== */
    .tab-button {
        padding: 10px 15px;
        text-decoration: none;
        font-weight: 500;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        /* Thêm hiệu ứng chuyển động mượt mà */
        transition: background-color 0.2s ease-in-out, color 0.2s ease-in-out;
    }

    /* Style cho tab không được chọn (mặc định) */
    .tab-button {
        background-color: #F0F0F0;
        color: #333;
        border: 1px solid #ccc;
        border-bottom: none;
    }

    /* Style cho tab ĐANG được chọn (active) */
    .tab-button.active {
        background-color: #A93226;
        color: white;
        border-color: #A93226;
    }
    /* ===== KẾT THÚC PHẦN TỐI ƯU ===== */
</style>
@endpush

<table>
    {{-- Hàng chứa thông tin và ảnh đại diện --}}
    <tr>
        <td style="width: 20%;height: 185px;text-align: center">
            <div class="w-full h-full overflow-hidden flex">
                @php
                    $imageUrl = '';
                    $nameForAvatar = $viTri->user->name ?? $viTri->ten_vi_tri ?? '??';
                    if ($viTri->user && $viTri->user->profile_photo_path) {
                        $imageUrl = 'https://drive.3d-smartsolutions.com/storage/' . $viTri->user->profile_photo_path;
                    } else {
                        $imageUrl = 'https://ui-avatars.com/api/?name=' . urlencode($nameForAvatar) . '&size=200&background=random';
                    }
                @endphp
                <img src="{{ $imageUrl }}" class="w-full object-cover" style="max-height: 200px" />
            </div>
        </td>
        <td style="vertical-align: top;">
            <p class="text-thong-tin"> Họ và tên: {{$nhanVien != null ?$nhanVien->name :'Đang cập nhật'}}</p>
            <p class="text-thong-tin"> Email: {{$nhanVien != null ? $nhanVien->email :'Đang cập nhật'}}</p>
            <p class="text-thong-tin"> Số điện thoại: {{$nhanVien != null && $nhanVien->profile != null ? $nhanVien->profile->phone :'Đang cập nhật'}}</p>
        </td>
    </tr>

    <tr>
        <td colspan="2">
            <div style="margin-top: 20px; display: flex; align-items: flex-end;">

                {{-- Tối ưu: Sử dụng @class directive của Blade --}}
                <a href="{{ route('front-vi-tri.show', $viTri) }}"
                   @class(['tab-button', 'active' => $action == 'show-mo-ta'])>
                    Mô tả công việc
                </a>

                @if($kiemTraCaNhan)

                {{-- Tối ưu: Áp dụng tương tự cho nút thứ hai --}}
                <a href="{{ route('front-vi-tri.show-huong-dan', ['id' => $viTri->id]) }}"
                   @class(['tab-button', 'active' => $action == 'show-huong-dan'])
                   style="margin-left: 5px;">
                    Hướng dẫn công việc
                </a>

                @endif

            </div>
        </td>
    </tr>
</table>
<x-user-component :viTri="$viTri" :roles="$roles"/>
