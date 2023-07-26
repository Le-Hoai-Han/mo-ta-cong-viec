<?php 
$current = "Thêm thông tin thưởng năm";
$list = [    
    url('/thuong-nhan-vien')=>'Danh sách thưởng năm'
]
?>
<x-dashboard-layout :current="$current" :list="$list">
    <div class="main-div">
        <div class="row " >
                <div class="col-12">
                    
                    <form name="them_thuong_nam" method="POST" id="frm_them_thuong_nam" action="{{route('thuong-nam.store')}}">
                    
                    @if($errors)
                    {{$errors}}
                    @endif
                        @csrf
                        <?php /*
                        <input type="hidden" name="hang_muc_thuong" value="{{$hangMucThuong->id}}">
                        <input type="hidden" name="cong_thuc_tinh" value="{{$congThucTinh->id}}">
                        */
                        ?>
                        <div class="card col-12 col-md-6">
                            <div class="card-header pb-0 p-3">
                                <div class="row">
                                    <div class="col-6 d-flex align-items-center">
                                        <h6 class="mb-0">Thêm thông tin thưởng năm</h6>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button type="submit" class="btn btn-primary btn-md mb-0">Lưu thông tin</button>
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                
                                <div class="col-12">                             
                                    
                                    <div class="col-12">
                                        <label class="label" for="nam">
                                            Áp dụng cho năm
                                        </label>
                                        <select class="form-control" name="nam" id="nam">
                                            <option value="{{date('Y')-1}}">Năm {{date('Y')-1}}</option>
                                            <option value="{{date('Y')}}" selected>Năm {{date('Y')}}</option>
                                            <option value="{{date('Y')+1}}">Năm {{date('Y')+1}}</option>                                            
                                        </select>
                                        @error('nam')
                                            <span class="help text-red-500"> {{ $message}}</span>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <label class="label" for="">
                                            Áp dụng cho nhóm
                                        </label>
                                        <select class="form-control" name="id_nhom_nhan_vien" id="id_nhom_nhan_vien">
                                            <option value=""></option>
                                            @foreach($dsNhomNhanVien as $nhomNhanVien)
                                                <option value="{{$nhomNhanVien->id}}">{{$nhomNhanVien->ten_nhom}}</option>
                                            @endforeach
                                        </select>
                                        @error('id_nhom_nhan_vien')
                                            <span class="help text-red-500"> {{ $message}}</span>
                                        @enderror
                                    </div> 
                                    <div class="form-group" id="div-chon-chi-tieu">
                                        
                                        <label for="example-text-input" class="form-control-label">Chọn nhân viên</label>
                                        <select name="nhan_vien[]" id="nhan_vien" aria-label="Người nhận chỉ tiêu" placeholder="Người nhận chỉ tiêu" multiple="multiple" class="form-control">
                                           
                                        </select>
                                        @error('nhan_vien')
                                            <span class="help text-danger"> {{ $message}}</span>
                                        @enderror
                                    </div>                                    
                                 
                                </div>    
                                <div class="col-12" >
                                    
                                        @include('front.thuong._list_chi_tieu')
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
        <script type="text/javascript">
            const dsNhanVien = <?php echo json_encode($dsNhanVien); ?>;
            const dsChiTieu = <?php echo json_encode($dsChiTieu); ?>;
            $("#div-chon-chi-tieu").hide();
            $("#div-chi-tieu").hide();
            // console.log(dsNhanVien);
            $(function () {
                
                // $("#hang_muc_thuong").selectize();
                // $("#cong_thuc_tinh").selectize();
                var $nhanVienSelect = $("#nhan_vien").selectize({
                    valueField: 'id',
                    labelField: 'text',
                    searchField: 'text'
                });
                $("#thang_su_dung").selectize();

                $("#id_nhom_nhan_vien").change(function(e){
                    let nhomNhanVien = e.target.value;
                    //select nhan vien                    
                    let control = $nhanVienSelect[0].selectize;
                    control.clear();
                    control.clearOptions();
                    if(dsNhanVien[nhomNhanVien]) {
                        
                        let dsNhanVienTheoNhom = dsNhanVien[nhomNhanVien];
                        for(idNhanVien in dsNhanVienTheoNhom) {
                            nhanVien = dsNhanVienTheoNhom[idNhanVien];

                            // console.log(nhanVien.ho_ten);
                            control.addOption({
                                id:idNhanVien,
                                text:nhanVien.ho_ten
                            });
                        }
                  

                    }
                    $("#div-chon-chi-tieu").show();
                    

                    //list chi tieu
                    let dsChiTieuTheoNhom = dsChiTieu[nhomNhanVien];
                    $("#tbody-chi-tieu").empty();
                    if(dsChiTieuTheoNhom) {
                        for(idChiTieu in dsChiTieuTheoNhom) {
                            chiTieu = dsChiTieuTheoNhom[idChiTieu];
                            console.log(chiTieu);
                            let row = '<tr>';
                            row += '<td class="col-12 col-md-4 col-xl-3" style="border:none;vertical-align:middle;text-align:right"><label>'+chiTieu.ten_chi_tieu+'</label></td>';
                            row += '<td class="col-12 col-md-8 col-xl-9" style="border:none">';

                            let chiTieuName = 'chi_tieu['+idChiTieu+']';
                            let mucTieu = 0;
                            if(chiTieu.muc_tieu_mac_dinh!==null) {
                                mucTieu = chiTieu.muc_tieu_mac_dinh*12;
                            }
                            row += '<input type="text" name="'+chiTieuName+'" value="'+mucTieu+'" class="form-control"/>';

                            row += '</td>';
                            row += '</tr>';

                            $('#tbody-chi-tieu').append(row);
                        }

                     
                    }
                    $("#div-chi-tieu").show();
                    // console.log(chiTieuTheoNhom);
                    
                })
            });
        
        </script> 
    @endpush
</x-dashboard-layout>