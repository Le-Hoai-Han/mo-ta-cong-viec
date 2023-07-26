<x-simple-card extClass="mt-3" headerClass="bg-secondary text-white "> 
    <x-slot name="title"><h6 class="text-white">Chỉ tiêu cá nhân tháng {{$thangNamThuong->thang}} năm {{$thangNamThuong->nam}}</h6></x-slot>
    <x-slot name="button">
        <button onclick="tinhThuongNhanVien('<?php echo route('thuong-nhan-vien.ket-qua.tinhThuong',[
                'thuongNhanVien'=>$thuongNhanVien,
                'ket_qua'=>$ketQuaTinhThuong->first()
            ])?>')" class="btn btn-success btn-md mb-2 " type="button" id="button-tong-thuong">
                <div class="d-flex align-items-center">
                    <span class='material-icons'>calculate</span>
                    Tính tỷ trọng
                </div>
            </button>
        @if(auth()->user()->can('edit_chitieu'))
           
            <a href="{{route('nhanVien.capNhatChiTieu',['thuongNhanVien'=>$thuongNhanVien])}}" class="btn btn-warning btn-md mb-2" type="button" id="button-tong-thuong"><div class="d-flex align-items-center">
                        <span class='material-icons'>edit_note</span>
                    Cập nhật
                </div>
            </a>
        @endif
    </x-slot>
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
                
                if(isset($ketQuaTinhThuong[$congThucTuongUng])) {
                    $tyTrongDatDuoc = thuGonSole($ketQuaTinhThuong[$congThucTuongUng]->ket_qua_tinh,3);
                }
                else {
                    $tyTrongDatDuoc = "Không tìm thấy";
                }

                $tiLeCongDon =  thuGonSoLe($chiTieu->ti_le_cong_don,3);
                if($tiLeCongDon == 100) {
                    $tiLeCongDonClass = 'text-success';
                } else if($tiLeCongDon == 0) {
                    $tiLeCongDonClass = 'text-danger';
                } else {
                    $tiLeCongDonClass = 'text-dark';
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
                $ketQua = "<span class='".$tiLeClass."'>" . thuGonSole($chiTieu->ket_qua_dat_duoc,3)."</span>";                
                
                $tiLe = "<span class='".$tiLeClass."'>" . $tiLeThang."%</span>";

               
            ?> 
            <tr>
                <th style="vertical-align:middle;border:none;text-align:center;font-weight:bold" ">{{$chiTieu->id_chi_tieu}}</th>
                <th style="vertical-align:middle;border:none;font-weight:600" ">{{$chiTieu->chiTieu->ten_chi_tieu}}</th>
                <td style="border:none;text-align:right;font-weight:600" >{!!$mucTieu!!}</td>
                <td style="border:none;text-align:right;font-weight:600" >{!!$ketQua!!}</td>
                <td style="border:none;text-align:right;font-weight:600" >{!!$tiLe!!}</td>
                <td style="border:none;text-align:right;font-weight:bold" ><a class="{{$tiLeCongDonClass}}" onclick="parseCongThuc({{$congThucTuongUng}})" style="cursor:pointer">{{$tyTrongDatDuoc}}%</a></td>
                <td style="border:none;text-align:right;font-weight:bold" ><a class="{{$tiLeCongDonClass}}" onclick="parseCongThuc({{$congThucTuongUng}})" style="cursor:pointer">{{$chiTieu->ty_trong_toi_da}}</a></td>
            </tr>
            @endforeach
            
            <tfoot class="table-dark">
                <tr>
                    <td colspan="5" style="border:none;text-align:right;font-weight:bold">Tổng tỷ trọng đạt được</td>
                    <td style="border:none;text-align:right;font-weight:bold">
                  
                    {{$ketQuaTinhThuong->first(function($value, $key) {
                            
                        return $value->congThuc->checkCongThucTongTyTrong() ;
                        })->ket_qua_tinh*100}}%
                        </td>
                        <td></td>
                </tr>
                
            </tfoot>
            
        </table>
        
    </div>
    
</x-simple-card>