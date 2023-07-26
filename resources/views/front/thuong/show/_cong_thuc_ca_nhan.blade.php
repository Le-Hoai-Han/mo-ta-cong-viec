<x-simple-card extClass="mt-3" headerClass="bg-secondary text-white">
    <x-slot name="title"><h6 class="text-white">Kết quả tính thưởng</h6></x-slot>
    <x-slot name="button">
        <?php 
        ?>
        <button onclick="tinhThuongNhanVien('<?php echo route('thuong-nhan-vien.ket-qua.tinhThuong',[
            'thuongNhanVien'=>$thuongNhanVien,
            'ket_qua'=>$ketQuaTinhThuong->first()
        ])?>')" class="btn btn-warning btn-md mb-2 " type="button" id="button-tong-thuong">
            <div class="d-flex align-items-center">
                <span class='material-icons'>update</span>
                Tính lại
            </div>
        </button>
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
            
            @foreach($ketQuaTinhThuong as $ketQua)
            <?php 
            $congThuc = $ketQua->congThuc; 
            
            ?>
            <tr>
                <th style="text-align:center">{{$congThuc->id}}</th>
                <td style="border:none"><a onclick="parseCongThuc({{$congThuc->id}})" style="cursor:pointer">
                {{$congThuc->ten_cong_thuc}}</a></td>
                <td style="border:none">{{$ketQua->noi_dung_cong_thuc}}</td>
                <td style="border:none">{{$ketQua->noi_dung_tinh}}</td>
                <td style="border:none">{{thuGonSoLe($ketQua->ket_qua_tinh,3)}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<x-info-cong-thuc-modal />
@push('scripts')
    <script defer>
        function tinhThuongNhanVien(tinhThuongUrl) {
            $.ajax({
                url: tinhThuongUrl,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",                    
                },
                dataType:'json',
                success:function(res) {                    
                    if(res.status=='success') {
                        location.reload();
                    } else {
                        console.log(res.message);
                    }
                    // console.log('ok');
                    // $("#deleteModal").modal('hide');
                    
                    
                }
            });
        }
        </script>
    @endpush
</x-simple-card>