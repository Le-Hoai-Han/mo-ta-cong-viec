@push('styles')
<style>
    .so-do-to-chuc {
        text-align: center;
        margin: 20px 0px;
    }

    .so-do-to-chuc_tieu_de {
        text-align: left;
        font-size: 20px;
        font-weight: bold;
    }

    .so_do {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 15px;
        position: relative;
    }

    .cap_tren_truc_tiep, .vi_tri_can_mo_ta, .trach-nhiem {
        background-color: white;
        border: 2px solid #333;
        padding: 15px;
        width: 300px;
        text-align: center;
        font-weight: bold;
        position: relative;
    }

    .vi_tri_can_mo_ta {
        border-radius: 20px;
    }

    .trach-nhiem {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Chia cột linh hoạt */
    gap: 15px; /* Khoảng cách giữa các ô */
    width: 800px;
    border: solid 2px #000;
    padding: 10px;
    background-color: #fff;
}

.trach-nhiem-text {
    text-decoration: none;
    color: #000;
    display: flex;
    align-items: center;
    justify-content: center;
    border: solid 1px #000;
    padding: 10px;
    text-align: center;
    min-height: 60px; /* Đảm bảo chiều cao đồng đều */
    border-radius: 8px;
}


    .line {
        width: 3px;
        height: 40px;
        background-color: black;
    }

</style>
@endpush
<div class="so-do-to-chuc">
    <p class="so-do-to-chuc_tieu_de"><b>{{ $sectionNumber }}. Sơ đồ tổ chức</b></p>

    <div class="so_do">
        <!-- Cấp trên -->
        <div class="cap_tren_truc_tiep">
            @if($viTri->id == 2)
                <h3>{{ $viTri->ten_vi_tri }}</h3>
            @else
                <h3>
                    @if($viTri->capQuanly)
                        <a id="id_vi_tri_quan_ly" href="{{ route('front-vi-tri.show', $viTri->capQuanly->id) }}" target="_blank">
                            {{ $viTri->capQuanly != null ? $viTri->capQuanly->ten_vi_tri : '' }}
                        </a>
                    @endif
                </h3>
            @endif
        </div>

        <!-- Đường nối giữa cấp trên và vị trí hiện tại -->
        <div class="line"></div>

        <!-- Vị trí hiện tại -->
        @if($viTri->id != 2)
            <div class="vi_tri_can_mo_ta">
                <h4>
                @if ($kiemTra)
                    <div data-action="updateViTri" data-fillable="ten_vi_tri" ondblclick="editTask(this, {{$viTri->id}})">
                        <a class="vi_tri_can_mo_ta_text" id="ten_vi_tri" >{{ $viTri->ten_vi_tri }}</a>
                    </div>
                @else
                    <div data-action="updateViTri" data-fillable="ten_vi_tri">
                        <a class="vi_tri_can_mo_ta_text" id="ten_vi_tri" >{{ $viTri->ten_vi_tri }}</a>
                    </div>
                @endif
                </h4>
            </div>
        @endif

        <!-- Đường nối giữa vị trí và trách nhiệm -->
        <div class="line"></div>

        <!-- Trách nhiệm chính -->
        <div class="trach-nhiem">
            @foreach($viTri->nhiemVu as $nhiemVu)
                <a class="trach-nhiem-text" href="#trach-nhiem-{{$loop->index + 1}}" id="ten_nhiem_vu_{{ $nhiemVu->id }}">
                    {{ $nhiemVu->ten_nhiem_vu }}
                </a>
            @endforeach
        </div>

    </div>
</div>
