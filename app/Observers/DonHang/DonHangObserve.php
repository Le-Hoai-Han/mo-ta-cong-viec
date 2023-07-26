<?php

namespace App\Observers\DonHang;

use App\Jobs\KiemTraThuongKyThuatJob;
use App\Models\DonHang\DonHang;
use App\Services\Thuong\NoXauService;
use Illuminate\Support\Facades\Date;

class DonHangObserve
{
   
    //tinh ngay ket thuc tinh thuong
    private function _capNhatNgayKetThucTinhThuong($ngayBatDau,$ngayTinhCongNo) : string 
    {
        // dd($ngayTinhCongNo);
        return endDateFromDays($ngayBatDau,$ngayTinhCongNo);
    }

    //tinh ngay ket thuc tinh thuong
    private function _capNhatNgayBatDauTinhThuong($ngayTaoDon) : string 
    {
        return date('Y-m-d', strtotime($ngayTaoDon));
    }


    /**
     * Handle the DonHang "creating" event.
     *
     * @param  \App\Models\DonHang\DonHang  $donHang
     * @return void
     */
    public function creating(DonHang $donHang)
    {
        if($donHang->ngay_nghiem_thu != null && $donHang->ngay_nghiem_thu != "1970-01-01" && $donHang->ngay_nghiem_thu != "") {
            //don hang chua duyet hoac ngay nghiem thu rong thi khong set ngay bat dau ket thuc
            $donHang->ngay_bat_dau_tinh_thoi_han = $this->_capNhatNgayBatDauTinhThuong($donHang->ngay_nghiem_thu);
            $donHang->ngay_ket_thuc_tinh_thuong = $this->_capNhatNgayKetThucTinhThuong($donHang->ngay_bat_dau_tinh_thoi_han,$donHang->so_ngay_tinh_cong_no);
        } else {
            $donHang->ngay_bat_dau_tinh_thoi_han = NULL;
            $donHang->ngay_ket_thuc_tinh_thuong = NULL;
            $donHang->duoc_tinh_thuong = DonHang::KHONG_TINH_THUONG;
        }
        
    }

    /**
     * Handle the DonHang "updated" event.
     *
     * @param  \App\Models\DonHang\DonHang  $donHang
     * @return void
     */
    public function updating(DonHang $donHang)
    {
        // echo $donHang->isDirty();
        if($donHang->isDirty('ngay_bat_dau_tinh_thoi_han') && $donHang->ngay_bat_dau_tinh_thoi_han != null && $donHang->ngay_bat_dau_tinh_thoi_han != "1970-01-01" && $donHang->ngay_bat_dau_tinh_thoi_han != "") {
            $donHang->ngay_ket_thuc_tinh_thuong = $this->_capNhatNgayKetThucTinhThuong($donHang->ngay_bat_dau_tinh_thoi_han,$donHang->so_ngay_tinh_cong_no);
        } else if($donHang->ngay_nghiem_thu != null && $donHang->ngay_nghiem_thu != "1970-01-01" && $donHang->ngay_nghiem_thu != "") {
    
            if($donHang->isDirty('ngay_nghiem_thu') || $donHang->isDirty('so_ngay_tinh_cong_no'))
            {
                $donHang->ngay_bat_dau_tinh_thoi_han = $this->_capNhatNgayBatDauTinhThuong($donHang->ngay_nghiem_thu);
                $donHang->ngay_ket_thuc_tinh_thuong = $this->_capNhatNgayKetThucTinhThuong($donHang->ngay_bat_dau_tinh_thoi_han,$donHang->so_ngay_tinh_cong_no);
            } else if(($donHang->ngay_bat_dau_tinh_thoi_han == '1970-01-01') || ($donHang->ngay_bat_dau_tinh_thoi_han == '') || ($donHang->ngay_bat_dau_tinh_thoi_han == null)) {
                $donHang->ngay_bat_dau_tinh_thoi_han = $this->_capNhatNgayBatDauTinhThuong($donHang->ngay_nghiem_thu);
                $donHang->ngay_ket_thuc_tinh_thuong = $this->_capNhatNgayKetThucTinhThuong($donHang->ngay_bat_dau_tinh_thoi_han,$donHang->so_ngay_tinh_cong_no);
            }
            
        } else  {
            $donHang->ngay_bat_dau_tinh_thoi_han = NULL;
            $donHang->ngay_ket_thuc_tinh_thuong = NULL;
            $donHang->duoc_tinh_thuong = DonHang::KHONG_TINH_THUONG;
        }

        /**
         * la no xau thi khong tinh
         */
        if($donHang->la_no_xau == DonHang::LA_NO_XAU) {
            $donHang->duoc_tinh_thuong = DonHang::KHONG_TINH_THUONG;
        }

        
        // them xu ly nhat ky cap nhat
    }

 
    /**
     * Handle the DonHang "deleted" event.
     *
     * @param  \App\Models\DonHang\DonHang  $donHang
     * @return void
     */

    public function updated(DonHang $donHang) {
        
        if($donHang->ngay_nghiem_thu != "" ) {
            KiemTraThuongKyThuatJob::dispatch($donHang);
            
        }

        if(!in_array($donHang->trang_thai,$donHang->trangThaiDonThuongKyThuat())) {
            foreach($donHang->thuongKyThuatDonHang as $thuongKyThuat) {
                $thuongKyThuat->delete();
            }
        }
    }
}
