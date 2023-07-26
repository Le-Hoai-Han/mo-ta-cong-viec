<?php 
$current = "Thông tin thưởng:  ".$thuongKhoangThoiGian->nhanVien->ho_ten;

?>
<x-dashboard-layout :current="$current">
    <div class="main-div">
        <div class="row " >
            @include('front.thuong.thuongnam.show._thong_tin_chung',[
                'thuongKhoangThoiGian'=>$thuongKhoangThoiGian,
                'dsQuyTinhThuong'=>$dsQuyTinhThuong,
                'dsNoXauDaTru'=>$dsNoXauDaTru,
                'tienThuongMoMoiDaNhan'=>$tienThuongMoMoiDaNhan
                ])
        </div>

       <!-- row cong thuc - chi tieu ca nhan -->
       <div class="row"> 
            <div class="col-12 col-xl-12">
            <?php 
                // $thuongKhoangThoiGian->thang_bat_dau = 1;
                // $thuongKhoangThoiGian->thang_ket_thuc = 12;
                ?>
                @include('front.thuong.thoigian.bieudo',[
                    'thuongKhoangThoiGian'=>$thuongKhoangThoiGian,
                    'dsChiTieu'=>$dsChiTieu
                    ])
            </div>
            <div class="col-12 col-xl-12">
                @include('front.thuong.thoigian.show._chi_tieu_thuong_thoi_gian',[
                    'thuongKhoangThoiGian'=>$thuongKhoangThoiGian,
                    'dsChiTieu'=>$dsChiTieu,
                    'congThucThuongThoiGian'=>$thuongKhoangThoiGian->congThucThuongTheoThoiGian->keyBy('id_cong_thuc_tinh')
                ])                    
            </div>

            <div class="col-12 col-xl-12">
                @include('front.thuong.thoigian.show._cong_thuc_thuong_thoi_gian',[
                    'thuongKhoangThoiGian'=>$thuongKhoangThoiGian,
                    'dsChiTieu'=>$dsChiTieu,
                    'congThucThuongThoiGian'=>$thuongKhoangThoiGian->congThucThuongTheoThoiGian->keyBy('id_cong_thuc_tinh')->sortBy('congThucTinh.loai')
                ])  
            </div>

        </div>

        <div class="row"> 
         

            <div class="col-12 col-xl-12">
                @include('front.thuong.thoigian.show._don_hang_tinh_thuong',[
                    'thuongThoiGian'=>$thuongKhoangThoiGian,
                    'dsDonHang'=>$dsDonHangTinhThuong
                ])                    
            </div>
            
            <div class="col-12 col-xl-12">
            @include('front.thuong.thoigian.show._don_hang_trong_ki_thuong',[
                    'thuongThoiGian'=>$thuongKhoangThoiGian,
                    'dsDonHang'=>$dsDonHangTrongThoiGian
                    ])                    
            </div> 
            
        </div>
        @if($dsNoXauDaTru->isNotEmpty())
        <div class="row" id='no-xau-da-tru-list'> 
         

            <div class="col-12 col-xl-12">
                @include('front.thuong.thuongnam.show._no_xau_da_tru',[
                    'thuongThoiGian'=>$thuongKhoangThoiGian,
                    'dsNoXauDaTru'=>$dsNoXauDaTru
                ])                    
            </div>
            
           
            
        </div>
        @endif
       
    </x-dashboard-layout>