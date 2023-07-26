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
                
                
                
            </div>

            <div class="col-12 col-xl-6">
                @include('run.nhanvien.show._thuong_trong_nam',[
                    'nhanVien'=>$nhanVien,
                    'dsThuongTrongNam'=>$dsThuongTrongNam
                ])                 
            </div>
            @if($dsLoaiThuongKyThuat)
                <div class="col-12 col-xl-6">
                    @include('run.nhanvien.show._danh_sach_loai_thuong_ky_thuat',[
                            'dsLoaiThuongKyThuat' => $dsLoaiThuongKyThuat
                            ])               
                </div>
            @endif
            @if($dsMucThuong)
                <div class="col-12 col-xl-6">
                    @include('run.nhanvien.show._danh_sach_muc_thuong_ky_thuat',[
                            'dsMucThuong' => $dsMucThuong
                            ])               
                </div>
            @endif
            @if($dsThuongLapDatDaoTao)
                <div class="col-12">
                @include('front.thuong-ky-thuat.show._grid_don_hang_thuong_ky_thuat',[
                        'dsThuongKyThuatDonHang' => $dsThuongLapDatDaoTao
                    ]) 
                </div> 
            @endif
            <?php /*
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
            @endif  */?>
            
        </div>
      
        @if(isset($dsThuongSanPhamQuanLy))
            <!-- row don hang có sản phẩm quản lý -->
                

                <div class="col-12">
                    @include('run.nhanvien.show._danh_sach_san_pham_quan_ly',[
                        'nhanVien'=>$nhanVien,
                        'dsThuongSanPhamQuanLy'=>$dsThuongSanPhamQuanLy,
                        'thuongSanPhamQuanLy' =>$thuongSanPhamQuanLy
                        
                    ])
                </div>

                
            <!-- end row don hang trong thang - san pham trong thang -->
        @endif 
    </div>


    
    </x-dashboard-layout>