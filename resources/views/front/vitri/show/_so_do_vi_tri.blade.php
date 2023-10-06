<div class="so-do-to-chuc">
    <p style="text-align: left" class="so-do-to-chuc_tieu_de"><b>3. Sơ đồ tổ chức</b></p>
    <div class="so_do">
        <div class="cap_tren_truc_tiep">
            @if($viTri->id == 2)
            <h3> <a> {{ $viTri->ten_vi_tri}}</a></h3>
            @else
            <h3> <a href="{{route('front-vi-tri.show',$viTri->capQuanly->id)}}" target="_blank"> {{ $viTri->capQuanly != null ? $viTri->capQuanly->ten_vi_tri :''}}</a></h3>
            @endif
        </div>
        @if($viTri->id != 2)
        <div class="vi_tri_can_mo_ta">
            <h4><a class="vi_tri_can_mo_ta_text" >{{$viTri->ten_vi_tri}}</a></h4>
        </div>
        @endif

        <div class="trach-nhiem"><?php $i = 1 ?>
            @foreach($viTri->nhiemVu as $nhiemVu)
                <a class="trach-nhiem-text" href="#trach-nhiem-{{$i++}}"> - {{$nhiemVu->ten_nhiem_vu}}</a>
            @endforeach
        </div>

    </div>
</div>