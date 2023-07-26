<?php

namespace App\Providers;

use App\Models\DonHang\DonHang;
use App\Models\KhachHang;
use App\Models\Thuong\NoXauThuocNhanVien;
use App\Models\Thuong\ThuongKhoangThoiGian;
use App\Models\Thuong\ThuongNhanVien;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\KhachHangPolicy;
use App\Policies\NoXauPolicy;
use App\Policies\Thuong\ThuongThoiGianPolicy;
use App\Policies\ThuongNhanVienPolicy;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        KhachHang::class => KhachHangPolicy::class,
        ThuongNhanVien::class => ThuongNhanVienPolicy::class,
        ThuongKhoangThoiGian::class => ThuongThoiGianPolicy::class,
        NoXauThuocNhanVien::class => NoXauPolicy::class
    ];



    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::before(function ($user) {
            if ($user->hasRole('admin')) {
                return true;
            }
        });

        $this->registerPolicies();

    }
}
