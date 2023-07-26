<x-simple-card extClass="mt-3" headerClass="bg-primary text-white "> 
    <x-slot name="title"><h6 class="text-white">Chỉ tiêu cộng dồn</h6></x-slot>
    <x-slot name="button">
        
        @if(auth()->user()->can('edit_chitieu'))
        
            <button data-href="{{route('thuong-thoi-gian.cap-nhat-chi-tieu',['thuongKhoangThoiGian'=>$thuongKhoangThoiGian])}}" class="btn btn-warning btn-md mb-2" type="button" id="btn_cap_nhat_chi_tieu">
                <div class="d-flex align-items-center">
                        <span class='material-icons'>refresh</span>
                    Tính lại
                </div>
            </button>
        @endif
    </x-slot>
    <div class='alert alert-success text-white' id="chi-tieu-update-div" style="display:none">Cập nhật chỉ tiêu thành công</div>
    <div class="table-responsive">
        <table class="table table-responsive" id="table-chi-tieu">
            <thead class="table-dark">
                <tr>
                    
                </tr>
                <tr>
                    <th class="col-1">ID </th>
                    <th class="col-4">Tên chỉ tiêu</th>
                    <th class="col-3" style="text-align:right">Mục tiêu </th>
                    <th class="col-3" style="text-align:right">Kết quả </th>
                    <th class="col-1" style="text-align:center">Tỉ lệ<br>đạt được</th>
                    <th class="col-1" style="text-align:center">Tỷ trọng<br>đạt được</th>
                    <th class="col-1" style="text-align:center">Tỷ trọng<br>tối đa</th>
                </tr>
            </thead> 
            @foreach($dsChiTieu as $chiTieu)
            <?php
                $congThucTuongUng = $chiTieu->getCongThucTuongUng();
                // dd($congThucThuongThoiGian);
                if(isset($congThucThuongThoiGian[$congThucTuongUng])) {
                    $tyTrongDatDuoc = thuGonSole($congThucThuongThoiGian[$congThucTuongUng]->ket_qua_tinh,3);
                }
                else {
                    $tyTrongDatDuoc = "Không tìm thấy";
                }
                $tiLeThang = thuGonSole($chiTieu->ti_le_dat_duoc);
                if($tiLeThang == 100) {
                    $tiLeClass = 'text-primary';
                } else if($tiLeThang == 0) {
                    $tiLeClass = 'text-danger';
                } else {
                    $tiLeClass = '';
                }


                $idChiTieu = $chiTieu->id;
                $mucTieu = "<span class='".$tiLeClass."'> " . thuGonSole($chiTieu->muc_tieu) ."</span>";
                $ketQua = "<span class='".$tiLeClass."'>" . thuGonSole($chiTieu->ket_qua,3)."</span>";                  
                $tiLe = "<span class='".$tiLeClass."'>" . $tiLeThang."%</span>";
            ?> 
            <tr>
                <th style="vertical-align:middle;border:none;text-align:center;font-weight:bold" ">{{$chiTieu->id_chi_tieu}}</th>
                <th style="vertical-align:middle;border:none;font-weight:600" " >{{$chiTieu->chiTieu->ten_chi_tieu}}</th>
                <td style="border:none;text-align:right;font-weight:600" id="muc_tieu_{{$chiTieu->id}}">{!!$mucTieu!!}</td>
                <td style="border:none;text-align:right;font-weight:600" id="ket_qua_{{$chiTieu->id}}">{!!$ketQua!!}</td>
                
                <td style="border:none;text-align:right;font-weight:600" id="ti_le_{{$chiTieu->id}}">{!!$tiLe!!}</td> 
         
               <td style="border:none;text-align:right;font-weight:bold" ><a class="{{$tiLeClass}}" onclick="parseCongThuc({{$congThucTuongUng}})" style="cursor:pointer">{{$tyTrongDatDuoc}}%</a></td>
                <td style="border:none;text-align:right;font-weight:bold" ><a class="{{$tiLeClass}}" onclick="parseCongThuc({{$congThucTuongUng}})" style="cursor:pointer">{{$chiTieu->ty_trong_toi_da}}</a></td>
            </tr>
            @endforeach
            <tfoot class="table-dark">
                <tr>
                    <td colspan="5" style="border:none;text-align:right;font-weight:bold">Tổng tỷ trọng đạt được</td>
                    <td colspan="2" style="border:none;text-align:center;font-weight:bold">{{$congThucThuongThoiGian->first(function($value, $key) {
                            
                            return $value->congThucTinh->checkCongThucTongTyTrong();
                        })->ket_qua_tinh}}%
                    </td>
                </tr>
                
            </tfoot>
        </table>
        
    </div>
    @push('scripts')
    <script defer> 
        const capNhatChiTieuButton = document.querySelector('#btn_cap_nhat_chi_tieu');
        capNhatChiTieuButton.addEventListener('click',(e)=>{
            console.log(capNhatChiTieuButton.dataset.href);
            $.ajax({
                url: capNhatChiTieuButton.dataset.href,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",    
                },
                dataType:'json',
                success:function(result) {                    
                    if(result.status=='success') {
                        const dsChiTieu = result.data;
                        dsChiTieu.forEach(chiTieu=>{
                            $("#ket_qua_"+chiTieu.id).html(thuGonSoLe(chiTieu.ket_qua));
                            $("#muc_tieu_"+chiTieu.id).html(thuGonSoLe(chiTieu.muc_tieu));
                            $("#ti_le_"+chiTieu.id).html(thuGonSoLe(chiTieu.ti_le_dat_duoc));
                        });
                        $("#chi-tieu-update-div").show();
                        
                    }
                }
            });
        });
    </script> 
    @endpush 
</x-simple-card>