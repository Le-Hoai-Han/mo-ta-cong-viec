<x-simple-card extClass="mt-3" headerClass="bg-secondary text-white "> 
    <x-slot name="title"><h6 class="text-white">Chỉ tiêu cá nhân trong tháng</h6></x-slot>
    <x-slot name="button">
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
                    <th class="col-1">ID </th>
                    <th class="col-4">Tên chỉ tiêu</th>
                    <th class="col-3" style="text-align:right">Mục tiêu</th>
                    <th class="col-3" style="text-align:right">Kết quả  </th>
                    <th class="col-1" style="text-align:right">Tỉ lệ đạt được(%)</th>
                    <th class="col-1" style="text-align:right">Tỷ trọng/Tối đa(%)</th>
                </tr>
            </thead>
            @foreach($dsChiTieu as $chiTieu)
            <?php 
                $congThucTuongUng = $chiTieu->getCongThucTuongUng();
                $tyTrongDatDuoc = thuGonSole($ketQuaTinhThuong[$congThucTuongUng]->ket_qua_tinh);
                $idChiTieu = $chiTieu->id;
                $mucTieu = thuGonSoLe($chiTieu->muc_tieu);
                $ketQua = thuGonSoLe($chiTieu->ket_qua_dat_duoc);                
                $tiLe = thuGonSoLe($chiTieu->ti_le_dat_duoc);

                if($tiLe == 100) {
                    $tiLeClass = 'text-white bg-success';
                } else if($tiLe == 0) {
                    $tiLeClass = 'text-white bg-danger';
                } else {
                    $tiLeClass = '';
                }
            ?> 
            <tr>
                <th style="vertical-align:middle;border:none;text-align:center;font-weight:bold" class="{{$tiLeClass}}">{{$chiTieu->id_chi_tieu}}</th>
                <th style="vertical-align:middle;border:none" class="{{$tiLeClass}}">{{$chiTieu->chiTieu->ten_chi_tieu}}</th>
                <td style="border:none;text-align:right" class="{{$tiLeClass}}">{{$mucTieu}}</td>
                <td style="border:none;text-align:right" class="{{$tiLeClass}}">{{$ketQua}}</td>
                <td style="border:none;text-align:right" class="{{$tiLeClass}}">{{$tiLe}}</td>
                <td style="border:none;text-align:right" class="{{$tiLeClass}}"><a onclick="parseCongThuc({{$congThucTuongUng}})" style="cursor:pointer">{{$tyTrongDatDuoc}}</a></td>
            </tr>
            @endforeach
            
            <tfoot class="table-dark">
                <tr>
                    <td colspan="5" style="border:none;text-align:right;font-weight:bold">Tổng tỷ trọng đạt được</td>
                    <td style="border:none;text-align:right;font-weight:bold">{{$ketQuaTinhThuong->first(function($value, $key) {
                            return $value->congThuc->la_cong_thuc_chinh == 0;
                        })->ket_qua_tinh}}</td>
                </tr>
                <tr>
                    <td colspan="5" style="border:none;text-align:right;font-weight:bold">Tiền thưởng tháng đạt được</td>
                    <td style="border:none;text-align:right;font-weight:bold">{{$ketQuaTinhThuong->first()->ket_qua_tinh}}</td>
                </tr>
            </tfoot>
            
        </table>
    </div>
    
</x-simple-card>