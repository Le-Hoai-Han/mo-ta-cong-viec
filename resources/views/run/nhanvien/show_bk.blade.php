<?php 
$current = "Thông tin thưởng: $nhanVien->ho_ten ";

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
            @include('run.nhanvien.show_nhan_vien.thong_tin_chung',[
                'thuongNhanVien'=>$thuongNhanVien
                ])
        </div>
        <!-- row cong thuc - chi tieu ca nhan -->
        <div class="row"> 

            <div class="col-12 col-xl-6">
                @include('run.nhanvien.show_nhan_vien.cong_thuc_ca_nhan',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'ketQuaTinhThuong'=>$thuongNhanVien->ketQuaTinhThuong()->orderBy('id_cong_thuc','DESC')->get()
                    ]) 
            </div>
            <div class="col-12 col-xl-6">
                @include('run.nhanvien.show_nhan_vien.chi_tieu_ca_nhan',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'dsChiTieu'=>$dsChiTieu
                    ])                    
            </div>

        </div>
        <!-- end row cong thuc - chi tieu ca nhan -->

        <!-- row don hang trong thang - san pham trong thang -->
        <div class="row"> 
            

            <div class="col-12 col-xl-12">
                @include('run.nhanvien.show_nhan_vien.don_hang_tinh_thuong',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'dsDonHang'=>$dsDonHangTinhThuong
                    ])                    
            </div>

            <div class="col-12 col-xl-12">
                @include('run.nhanvien.show_nhan_vien.don_hang_trong_thang',[
                    'thuongNhanVien'=>$thuongNhanVien,
                    'dsDonHang'=>$dsDonHang
                    ])                    
            </div> 
          
        </div>
                <!-- end row don hang trong thang - san pham trong thang -->
    </div>

    @push('scripts')
    <script defer>
        // $('#btn_thuong_thang_chon').click(()=>{
        //     console.log(1);
        // });
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