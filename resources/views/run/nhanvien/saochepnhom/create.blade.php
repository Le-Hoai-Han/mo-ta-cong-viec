<?php 
$current = "Thêm chỉ tiêu";
$list = [
    route('chi-tieu.index')=>'Danh mục chỉ tiêu'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-xs-12">
                    <form name="them_chi_tieu" method="POST" id="frm_them_chi_tieu" action="{{route('chi-tieu.sao-chep.store')}}">
                        @csrf
        
                        <div class="card col-12 col-md-8">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Sao chép chỉ tiêu</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12">
                                            <label class="label" for="">
                                                Chọn nhóm muốn sao chép
                                            </label>
                                            <select class="form-control" name="id_nhom_nhan_vien" id="id_nhom_nhan_vien">
                                                <option value=""></option>
                                                @foreach($dsNhomNhanVien as $nhomNhanVien)
                                                    <option value="{{$nhomNhanVien->id}}">{{$nhomNhanVien->ten_nhom}}</option>
                                                @endforeach

                                            
                                            </select>
                                            @error('group')
                                                <span class="help text-red-500"> {{ $message}}</span>
                                            @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="label" for="">
                                            Chọn nhóm nhận chỉ tiêu
                                        </label>
                                        <select class="form-control" name="id_nhom_nhan_vien_ket_qua" id="id_nhom_nhan_vien_ket_qua">
                                            <option value=""></option>
                                            @foreach($dsNhomNhanVien as $nhomNhanVien)
                                                <option value="{{$nhomNhanVien->id}}">{{$nhomNhanVien->ten_nhom}}</option>
                                            @endforeach

                                        
                                        </select>
                                        <span class="help text-red-500" id="err_id_nhom_nhan_vien_ket_qua"></span>
                                    </div>

                                    <div class="col-12" >
                                    <label class="label" for="chi_tieu">
                                            Áp dụng cho nhóm
                                        </label>
                                        <select class="form-control" name="chi_tieu[]" id="chi_tieu" required multiple>
                                        </select>  

                                     
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>

    @push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/css/selectize.css">
    <link rel="stylesheet" href="{{asset('css/selectize-bootstrap-5.css')}}">
  
    @endpush

    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.3/js/standalone/selectize.min.js"></script>
        

       <script src="{{asset('js/slimselect.min.js')}}"></script>
       <script type="text/javascript">
        
            const dsChiTieu = <?php echo json_encode($dsChiTieu); ?>;
            
            $(function () {
                
                // $("#hang_muc_thuong").selectize();
                // $("#cong_thuc_tinh").selectize();
                
                var $chiTieuSelect = $("#chi_tieu").selectize({
                    valueField: 'id',
                    labelField: 'text',
                    searchField: 'text',
                    
                });

                

                const clearChiTieuOptions = (control) => { 
                                       
                    control.clear();
                    control.clearOptions();   
                }

                const addChiTieuOptions = (control,nhomNhanVien) => {
                    let dsChiTieuTheoNhom = dsChiTieu[nhomNhanVien];
                    
                    if(dsChiTieuTheoNhom) {
                        
                            for(idChiTieu in dsChiTieuTheoNhom) {
                                chiTieu = dsChiTieuTheoNhom[idChiTieu];
                                control.addOption({
                                id:idChiTieu,
                                text:chiTieu.ten_chi_tieu
                            });
                            }
                        }
                }

                const showNhomTrungError = () => {
                    $("#err_id_nhom_nhan_vien_ket_qua").html('Nhóm chọn sao chép và nhóm nhận chỉ tiêu phải khác nhau').show();
                }

                const hideNhomTrungError = () => {
                    $("#err_id_nhom_nhan_vien_ket_qua").empty().hide();
                }



                hideNhomTrungError();
                $("#id_nhom_nhan_vien_ket_qua").change(function(e){
                    let nhomKetQua = e.target.value;  
                    let nhomNhanVien = $("#id_nhom_nhan_vien").val(); 
                    let control = $chiTieuSelect[0].selectize;
                    if(nhomKetQua == nhomNhanVien) {
                        clearChiTieuOptions(control);

                        showNhomTrungError();
                    } else {
                        hideNhomTrungError();
                        addChiTieuOptions(control,nhomNhanVien);
                    }  
                    

                });

                $("#id_nhom_nhan_vien").change(function(e){                    
                    let nhomNhanVien = e.target.value;   
                    let control = $chiTieuSelect[0].selectize;
                    clearChiTieuOptions(control);
                    //2 nhom giong nhau thi xoa het chi tieu + thong bao loi
                    let nhomKetQua = $("#id_nhom_nhan_vien_ket_qua").val(); 

                    if(nhomKetQua == nhomNhanVien) {
                        showNhomTrungError();
                        return false;
                    } else {
                        hideNhomTrungError();
                        addChiTieuOptions(control,nhomNhanVien);
                    } 
                    
                    //list chi tieu
                   
                });
            });
        </script>
    @endpush
</x-dashboard-layout>