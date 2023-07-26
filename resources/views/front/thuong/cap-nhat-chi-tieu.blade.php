<x-dashboard-layout>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <form action="{{route('nhanVien.luuCapNhatChiTieu',['thuongNhanVien'=>$thuongNhanVien])}}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="card-header">
                    <div class="row">
                        <div class="col-8"><h4>Cập nhật chỉ tiêu cá nhân</h4></div>
                        <div class="col-4 text-end">
                            <a href="{{route('thuong-nhan-vien.show',['thuong_nhan_vien'=>$thuongNhanVien])}}" class="btn btn-dark btn-md mb-0">Quay lại</a>
                            <button class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                            
                            <!-- <a class="btn btn-info btn-md mb-0" href="{{route('donhang.requestStoring')}}">Cập nhật danh sách</a>
                            <a class="btn btn-warning btn-md mb-0" href="{{route('donhang.tinhTatCa')}}">Tính tất cả</a>                             -->
                        </div>
                    </div>
                </div>
                <div class="card-body over-flow-y">
                    <div class="row">
                        <div class="form-group col-12 col-md-6">
                            <label for="id_nhan_vien" class="form-control-label">Nhân viên</label>
                            <input type="text" value="{{$thuongNhanVien->nhanVien->ho_ten}}" readonly class="form-control" />
                        </div>
                        <div class="form-group col-12 col-md-6">
                            <label for="thang_su_dung" class="form-control-label">Thời gian áp dụng</label>
                            <input type="text" value="{{'Tháng '.$thuongNhanVien->thangNam->thang.'/'.$thuongNhanVien->thangNam->nam}}" readonly class="form-control" />
                            <!-- <select name="thang_su_dung" id="thang_su_dung" aria-label="Tháng" placeholder="Thời gian áp dụng" class="form-control ">
                            
                                @foreach ($dsThangNam as $thang):
                                    <option value="{{$thang->id}}" 
                                    @if($thang->id == $thuongNhanVien->id_thang_nam)
                                        selected
                                    @endif
                                    >Tháng {{$thang->thang}}/{{$thang->nam}}</option>
                                @endforeach
                            </select>
                            @error('thang_su_dung')
                                <span class="help text-danger"> {{ $message}}</span>
                            @enderror -->
                        </div>
                        <table class="table" id="table-chi-tieu">
                            <thead class="bg-secondary text-white">
                                <tr>
                                    <th>Tên chỉ tiêu</th>
                                    <th>Mục tiêu</th>
                                    <th>Kết quả đạt được</th>
                                    <th>Tỉ lệ (%)</th>                                    
                                </tr>
                            </thead>
                            <?php $tabIndex=1; ?>
                            @foreach($dsChiTieu as $chiTieu)
                            <?php 
                                
                                $idChiTieu = $chiTieu->id;
                                $mucTieu = thuGonSoLe($chiTieu->muc_tieu);
                                $ketQua = thuGonSoLe($chiTieu->ket_qua_dat_duoc);
                                $tiLe = thuGonSoLe($chiTieu->ti_le_dat_duoc);
                                $getDataButton = "";
                                $idTextBox = "ket_qua_".$idChiTieu;
                                if(in_array($chiTieu->id_chi_tieu, $chiTieu::CHI_TIEU_DOANH_SO)) {
                                    $getDataButton = "<a title='Cập nhật từ hệ thống' onclick='tinhDoanhSoThang(\"".route('nhanVien.tinhDoanhSothang',['thuongNhanVien'=>$thuongNhanVien])."\")' class='text-warning'><span class='material-icons' style='cursor:pointer'>
                                    sync
                                    </span></a>";
                                    $idTextBox="chi_tieu_doanh_so";
                                }
                                if(in_array($chiTieu->id_chi_tieu, $chiTieu::CHI_TIEU_SO_DON_HANG)) {
                                    $getDataButton = "<a title='Cập nhật từ hệ thống' onclick='tinhSoDonHangThang(\"".route('nhanVien.tinhSoDonHangThang',['thuongNhanVien'=>$thuongNhanVien])."\")' class='text-warning'><span class='material-icons' style='cursor:pointer'>
                                    sync
                                    </span></a>";
                                    $idTextBox="chi_tieu_so_don_hang";
                                }
                                if(in_array($chiTieu->id_chi_tieu, $chiTieu::CHI_TIEU_TRAINING)) {
                                    $getDataButton = "<a title='Cập nhật từ hệ thống phòng họp' onclick='capNhatTraining(\"".route('thuong-nhan-vien.thongKeDaoTao')."\")' class='text-warning'><span class='material-icons' style='cursor:pointer'>
                                    sync
                                    </span></a>";
                                    $idTextBox="chi_tieu_training";
                                }
                                if(in_array($chiTieu->id_chi_tieu, $chiTieu::CHI_TIEU_REORDER)) {
                                    $getDataButton = "<a title='Cập nhật từ hệ thống phòng họp' onclick='capNhatReOrder(\"".route('thong-ke.donHangMuaLai')."\")' class='text-warning'><span class='material-icons' style='cursor:pointer'>
                                    sync
                                    </span></a>";
                                    $idTextBox="chi_tieu_reorder";
                                }
                            ?> 
                            <tr>
                                <th class="d-flex align-items-center">{{$chiTieu->chiTieu->ten_chi_tieu}} {!!$getDataButton!!}</th>
                                <td><input type="text" name="chitieu[<?php echo $idChiTieu;?>][muc_tieu]" value="{{$mucTieu}}" class="form-control" /></td>
                                <td><input type="text" tabindex="{{$tabIndex}}" name="chitieu[<?php echo $idChiTieu;?>][ket_qua_dat_duoc]" value="{{$ketQua}}" class="form-control" id="{{$idTextBox}}"/></td>
                                <td><input type="text" name="chitieu[<?php echo $idChiTieu;?>][ti_le_dat_duoc]" value="{{$tiLe}}" class="form-control" readonly /></td>
                            </tr>
                            <?php 
                                 $tabIndex = $tabIndex++;
                            ?>
                            @endforeach
                            
                        </table>
                    </div>
                </div>
                            
                </form>
            </div>
        </div>
    </div>
    @push('styles')
    <style>
        #table-chi-tieu tr,
        #table-chi-tieu td,
        #table-chi-tieu th{
            border:none;
        }
    </style>
    @endpush
    @push('scripts')
        <script>
            const tinhDoanhSoThang = (url) => {
                $.ajax({
                    url:url,
                    type:"post",
                    dataType:'json',
                    data:{
                        '_token':"<?php echo csrf_token(); ?>"
                    },
                    success:function(data){
                        $("#chi_tieu_doanh_so").val(data);
                        $("#chi_tieu_doanh_so").addClass('text-white bg-success');
                    }
                });
            }
            const tinhSoDonHangThang = (url) => {
                $.ajax({
                    url:url,
                    type:"post",
                    dataType:'json',
                    data:{
                        '_token':"<?php echo csrf_token(); ?>"
                    },
                    success:function(data){
                        $("#chi_tieu_so_don_hang").val(data);
                        $("#chi_tieu_so_don_hang").addClass('text-white bg-success');
                    }
                });
            }
            const capNhatTraining =(url)=>{
                $.ajax({
                    url:url,
                    type:"post",
                    dataType:'json',
                    data:{
                        '_token':"<?php echo csrf_token(); ?>",
                        'email':"{{$thuongNhanVien->nhanVien->user->email}}",
                        'thang':"{{$thuongNhanVien->thangNam->thang}}",
                        'nam':"{{$thuongNhanVien->thangNam->nam}}",
                          
                    },
                    success:function(data){
                        $("#chi_tieu_training").val(data);
                        $("#chi_tieu_training").addClass('text-white bg-success');
                    }
                })
            }
            const capNhatReOrder =(url)=>{
                $.ajax({
                    url:url,
                    type:"post",
                    dataType:'json',
                    data:{
                        '_token':"<?php echo csrf_token(); ?>",
                        'id':"{{$thuongNhanVien->nhanVien->id}}",
                        'thang':"{{$thuongNhanVien->thangNam->thang}}",
                        'nam':"{{$thuongNhanVien->thangNam->nam}}",
                          
                    },
                    success:function(data){
                        $("#chi_tieu_reorder").val(data);
                        $("#chi_tieu_reorder").addClass('text-white bg-success');
                    }
                })
            }
        </script>
    @endpush
</x-dashboard-layout>
    