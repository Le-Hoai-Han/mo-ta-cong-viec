<?php 
$current = "Thông tin thưởng: $nhanVien->ho_ten ";

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
            @include('front.thuong.show._thong_tin_chung',[
                'thuongNhanVien'=>$thuongNhanVien,
                'thangNamThuong'=>$thangNamThuong
                ])
        </div>

       

        <!-- row cong thuc - chi tieu ca nhan -->
        <div class="row"> 

            <div class="col-12 col-xl-12">
                @include('front.thuong.show._chi_tieu_ca_nhan',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'dsChiTieu'=>$dsChiTieu,
                    'ketQuaTinhThuong'=>$dsKetQuaTinhThuong,
                    'thangNamThuong'=>$thangNamThuong
                    ])                    
            </div>
            <div class="col-12 col-xl-12">
                @include('front.thuong.show._cong_thuc_ca_nhan',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'ketQuaTinhThuong'=>$dsKetQuaTinhThuong,
                    'thangNamThuong'=>$thangNamThuong
                ])
            </div>
        </div>

         {{-- Mở mới --}}

         {{-- <div class="row">
            <div class="col12 col-xl-12">
                @include('run.thuong-mo-moi.show-nhan-vien.mo-moi',[
                    'dsDonHang'=>$dsDonHangThuongMoMoi,
                    'thangNamThuong'=>$thangNamThuong
                    ])
            </div>
        </div> --}}


        <!-- end row cong thuc - chi tieu ca nhan -->

        <!-- row don hang trong thang - san pham trong thang -->
        <div class="row"> 
         

            <div class="col-12 col-xl-12">
                @include('front.thuong.show._don_hang_tinh_thuong',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'dsDonHang'=>$dsDonHangTinhThuong,
                    'thangNamThuong'=>$thangNamThuong
                    ])                    
            </div>
          
            <div class="col-12 col-xl-12">
                @include('front.thuong.show._don_hang_trong_thang',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'dsDonHang'=>$dsDonHang,
                    'thangNamThuong'=>$thangNamThuong
                    ])                    
            </div> 

            @if($coThuongMoMoi)
            {{-- Các đơn hàng có cơ hội thưởng mở mới --}}
            <div class="col-12 col-xl-12">
                @include('run.thuong-mo-moi.donhangcohoi.don-hang-co-hoi-thuong-mo-moi',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'dsDonHang'=>$dsDonHangCoHoiThuongMoMoi
                    ])
            </div>  
            
            <div class="col-12 col-xl-12">
                @include('run.thuong-mo-moi.show-nhan-vien.mo-moi',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'dsDonHang'=>$dsDonHangThuongMoMoi,
                    'dsDonHangThuocNhomQuanLy'=>$dsDonHangThuocNhomQuanLy
                    ])
            </div>  
            @endif
        </div>
                <!-- end row don hang trong thang - san pham trong thang -->
    </div>

    @push('scripts')
    <script defer>
        
        function tinhNganSachThuong(url) {
            $.ajax({
                url: url,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",    
                    "id_thang_nam": $("#thang_su_dung").val(),
                },
                dataType:'json',
                success:function(res) {                    
                    if(res.status=='success') {
                        
                        $("#ngan_sach_thuong_value").val(res.message).attr('class','form-control text-success');
                    } else {
                        $("#ngan_sach_thuong_value").val(res.message).attr('class','form-control text-danger');
                    }
                }
            });
        }

        function tinhTongTienThuong(url) {
            $.ajax({
                url: url,
                type:'POST',
                data:{
                    "_token": "{{ csrf_token() }}",                    
                },
                dataType:'json',
                success:function(res) {                    
                    if(res.status=='success') {
                        
                        $("#tong_tien_thuong_dat_duoc_value").val(res.message).attr('class','form-control text-success');
                    } else {
                        $("#tong_tien_thuong_dat_duoc_value").val(res.message).attr('class','form-control text-danger');
                    }
                }
            });
        }
    </script>
    @endpush
    </x-dashboard-layout>