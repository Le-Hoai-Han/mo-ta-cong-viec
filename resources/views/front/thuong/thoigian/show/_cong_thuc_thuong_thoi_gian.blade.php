<x-simple-card extClass="mt-3" headerClass="bg-secondary text-white">
    <x-slot name="title"><h6 class="text-white">Kết quả tính thưởng</h6></x-slot>
    <x-slot name="button">
        <?php 
        ?>
        @if(auth()->user()->can('edit_chitieu'))
        
            <button data-href="{{route('thuong-thoi-gian.cap-nhat-chi-tieu',['thuongKhoangThoiGian'=>$thuongKhoangThoiGian])}}" class="btn btn-warning btn-md mb-2" type="button" id="btn_cap_nhat_chi_tieu">
                <div class="d-flex align-items-center">
                        <span class='material-icons'>refresh</span>
                    Tính lại
                </div>
            </button>
        @endif
    </x-slot>
    <div class="table-responsive">
    <table class="table table-borderless" id="table-chi-tieu">
        <thead class="table-dark">
            <tr>
                <th class="col-1">ID</th>
                <th class="col-7" style="overflow-x:auto;">Tên công thức</th>
                <th class="col-2" >Nội dung công thức</th>
                <th class="col-2" >Nội dung tính</th>
                <th class="col-2" style="text-align:right">Kết quả</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($congThucThuongThoiGian as $congThucThuong)
            <?php 
                $congThuc = $congThucThuong->congThucTinh; 
            ?>
            <tr>
                <th style="text-align:center">{{$congThuc->id}}</th>
                <td style="border:none"><a onclick="parseCongThuc({{$congThuc->id}})" style="cursor:pointer">
                {{$congThuc->ten_cong_thuc}}</a></td>
                <td style="border:none"><a onclick="parseCongThuc({{$congThuc->id}})" style="cursor:pointer">{{$congThucThuong->noi_dung_cong_thuc}}</a></td>
                <td style="border:none"><a onclick="parseCongThuc({{$congThuc->id}})" style="cursor:pointer">{{$congThucThuong->noi_dung_tinh}}</a></td>
                <td style="border:none">{{thuGonSoLe($congThucThuong->ket_qua_tinh,3)}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<x-info-cong-thuc-modal />

</x-simple-card>