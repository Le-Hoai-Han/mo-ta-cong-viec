<?php 
$current = "Thông tin nhân viên: $nhanVien->ho_ten ";

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
        
        </div>
        <!-- row cong thuc - chi tieu ca nhan -->
        <div class="row"> 

            <div class="col-12 col-xl-6">
                @include('run.nhanvien.show._thong_tin_chung',[
                        'nhanVien'=>$nhanVien
                    ])
                @include('run.nhanvien.show._search_nam_thuong',[
                    'nhanVien'=>$nhanVien
                ])    
                @include('run.nhanvien.show._thong_so_don_hang',[
                    'nhanVien' => $nhanVien,
                    'tongDoanhThu' => $tongDoanhThu,
                    'tongSoDonHang' => $tongSoDonHang,
                    'tongNoXau' => $nhanVien->tongNoXauCanTru()
                ])
                        
                
            </div>

            <div class="col-12 col-xl-6">
                @include('run.nhanvien.show._thuong_trong_nam',[
                    'nhanVien'=>$nhanVien,
                    'dsThuongTrongNam'=>$dsThuongTrongNam
                ])                 
            </div>
            @if($thuongKhoangThoiGian!=null)
            <div class="row"> 
                <div class="col-12 col-xl-12">
                <?php 
                    // $thuongKhoangThoiGian->thang_bat_dau = 1;
                    // $thuongKhoangThoiGian->thang_ket_thuc = 12;
                    ?>
                    @include('front.thuong.thoigian.bieudo',[
                        'thuongKhoangThoiGian'=>$thuongKhoangThoiGian,
                        'dsChiTieu'=>$dsChiTieuNam
                        ])
                </div>
                <div class="col-12 col-xl-12">                
                    @include('front.thuong.thoigian.show._chi_tieu_thuong_thoi_gian',[
                        'thuongKhoangThoiGian'=>$thuongKhoangThoiGian,
                        'dsChiTieu'=>$dsChiTieuNam,
                        'congThucThuongThoiGian'=>$thuongKhoangThoiGian->congThucThuongTheoThoiGian->keyBy('id_cong_thuc_tinh')
                    ])                    
                </div>

                <div class="col-12 col-xl-12">
                    @include('front.thuong.thoigian.show._cong_thuc_thuong_thoi_gian',[
                        'thuongKhoangThoiGian'=>$thuongKhoangThoiGian,
                        'dsChiTieu'=>$dsChiTieuNam,
                        'congThucThuongThoiGian'=>$thuongKhoangThoiGian->congThucThuongTheoThoiGian->keyBy('id_cong_thuc_tinh')->sortBy('congThucTinh.loai')
                    ])  
                </div>

            </div>
            @else
            @endif 
            <div class="col-12 ">
                @include('run.nhanvien.show._don_hang_nhan_vien',[
                        'nhanVien'=>$nhanVien,
                        'dsDonHang'=>$dsDonHang,
                        'nam'=>$nam
                    ])
            </div>
        </div>
        <!-- end row cong thuc - chi tieu ca nhan -->

        @if(isset($dsSanPhamQuanLy))
            <!-- row don hang có sản phẩm quản lý -->
            <div class="row"> 
                

                <div class="col-12 col-xl-12">
                    @include('run.nhanvien.show._danh_sach_san_pham_quan_ly',[
                        'nhanVien'=>$nhanVien,
                        'dsSanPhamQuanLy'=>$dsSanPhamQuanLy,
                        'nam'=>$nam
                    ])
                </div>

                
            </div>
            <!-- end row don hang trong thang - san pham trong thang -->
        @endif 
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