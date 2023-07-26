<?php

namespace App\Providers;

use App\Models\DonHang\DonHang;
use App\Models\DonHang\DonHangGetFly;
use App\Observers\DonHang\DonHangObserve;
use App\Observers\DonHangGetflyObserver;
use App\View\Components\BieuDo\BaseChart;
use App\View\Components\Button\BaseLink;
use App\View\Components\Button\LinkQuayVe;
use App\View\Components\Button\LinkThemMoi;
use App\View\Components\CongThuc\Modal;
use App\View\Components\Button\LinkCapNhat;
use App\View\Components\Button\LinkXem;
use App\View\Components\Button\LinkXoa;
use App\View\Components\CardSmall;
use App\View\Components\SimpleCard;
use App\View\Components\TrangThaiKhoaSwitch;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        DonHang::observe(DonHangObserve::class);
        DonHangGetFly::observe(DonHangGetflyObserver::class);
        Schema::defaultStringLength(191);
        Blade::component('info-cong-thuc-modal', Modal::class);
        Blade::component('simple-card',SimpleCard::class);
        Blade::component('trang-thai-switch',TrangThaiKhoaSwitch::class);
        Blade::component('link-them-moi',LinkThemMoi::class);
        Blade::component('link-quay-ve',LinkQuayVe::class);
        Blade::component('link-cap-nhat',LinkCapNhat::class);
        Blade::component('link-xem',LinkXem::class);
        Blade::component('base-link',BaseLink::class);
        Blade::component('link-xoa',LinkXoa::class);
        Blade::component('base-chart',BaseChart::class);
        Blade::component('card-small',CardSmall::class);
    }
}
