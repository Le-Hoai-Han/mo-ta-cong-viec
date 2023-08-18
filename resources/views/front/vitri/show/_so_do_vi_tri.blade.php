<div class="so-do-to-chuc">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>3. Sơ đồ tổ chức</b></p>
    <div class="so_do">
        <div class="cap_tren_truc_tiep">
            <h3>{{$viTri->capQuanly->user->name}}</h3>
        </div>

        <div class="vi_tri_can_mo_ta">
            <h4><a class="vi_tri_can_mo_ta_text">{{$viTri->ten_vi_tri}}</a></h4>
        </div>

        <div class="trach-nhiem">
            @foreach($viTri->nhiemVu as $nhiemVu)
                <a class="trach-nhiem-text" href="{{route('nhiem-vu.show',$nhiemVu)}}">- {{$nhiemVu->ten_nhiem_vu}}</a>
            @endforeach
        </div>

    </div>
</div>