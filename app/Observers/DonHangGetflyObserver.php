<?php

namespace App\Observers;

use App\Models\Donhang\DonHangGetfly;
use App\Models\NhanVien;
use App\Services\DonHang\DonHangGetFlyService;

class DonHangGetflyObserver
{
    /**
     * Handle the DonHangGetfly "created" event.
     *
     * @param  \App\Models\Donhang\DonHangGetfly  $donHangGetfly
     * @return void
     */

     /** dùng trang_thai có khả năng sẽ ảnh hưởng nếu sau này nhầm giữa model getfly và đơn hàng thường
      * dùng thêm biến trạng thái getfly để cập nhật trạng thái gốc khi set value sẽ an toàn hơn
      * vì vậy cũng ko cần thiết observe creating và updating
      */
    // public function creating(DonHangGetfly $donHangGetfly)
    // {
    //     // dd($donHangGetfly);
    //     switch($donHangGetfly->trang_thai_getfly){
    //         // case 1:
    //         //     $donHangGetfly->trang_thai = DonHangGetfly::TT_MOI; 
    //         //     break;
    //         case 2:
    //             $donHangGetfly->trang_thai = DonHangGetfly::TT_DUYET;
    //             break;
    //         case 4:
    //             $donHangGetfly->trang_thai = DonHangGetfly::TT_DA_HOAN_THANH;
    //             break;
    //         case 5:
    //             $donHangGetfly->trang_thai = DonHangGetfly::TT_HUY;
    //             break;
    //         default:
    //             $donHangGetfly->trang_thai = DonHangGetfly::TT_MOI;
    //             break;
    //         }
    // }
    public function created(DonHangGetfly $donHangGetfly)
    {
        // dd(date('Y-m-d',strtotime(str_replace('/','-',$donHangGetfly->ngay_tao_don))));
        // $donHangGetfly->ngay_bat_dau_tinh_thoi_han =date('Y-m-d',strtotime(str_replace('/','-',$donHangGetfly->ngay_tao_don)));
        // $donHangGetfly->ngay_ket_thuc_tinh_thuong = date('Y-m-d', strtotime($donHangGetfly->ngay_bat_dau_tinh_thoi_han . " +60 days"));
    }

    /**
     * Handle the DonHangGetfly "updated" event.
     *
     * @param  \App\Models\Donhang\DonHangGetfly  $donHangGetfly
     * @return void
     */
    public function updating(DonHangGetfly $donHangGetfly)
    {
        
    }

    public function updated(DonHangGetfly $donHangGetfly)
    {
        // dd($donHangGetfly);
    }
    /**
     * Handle the DonHangGetfly "deleted" event.
     *
     * @param  \App\Models\Donhang\DonHangGetfly  $donHangGetfly
     * @return void
     */
    public function deleted(DonHangGetfly $donHangGetfly)
    {
        //
    }

    /**
     * Handle the DonHangGetfly "restored" event.
     *
     * @param  \App\Models\Donhang\DonHangGetfly  $donHangGetfly
     * @return void
     */
    public function restored(DonHangGetfly $donHangGetfly)
    {
        //
    }

    /**
     * Handle the DonHangGetfly "force deleted" event.
     *
     * @param  \App\Models\Donhang\DonHangGetfly  $donHangGetfly
     * @return void
     */
    public function forceDeleted(DonHangGetfly $donHangGetfly)
    {
        //
    }
}
