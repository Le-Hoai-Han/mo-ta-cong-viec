<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\front\UserController as FrontUserController;
use App\Http\Controllers\MoTaNhiemVuController;
use App\Http\Controllers\NhiemVuController;
use App\Http\Controllers\QuanHeController;
use App\Http\Controllers\ThamQuyenController;
use App\Http\Controllers\TieuChuanTuyenChonController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViTriController;
use App\Models\ThamQuyen;
use App\Models\TieuChuanTuyenChon;
use App\Http\Controllers\Front\FrontViTriController;
use App\Http\Controllers\Front\FrontNhiemVuControler;
use App\Http\Controllers\Front\FrontNhiemVuController;
use App\Http\Controllers\Front\FrontMoTaNhiemVuController;
use App\View\Components\FrontLayout;
use App\Http\Controllers\Front\FrontQuanHeController;
use App\Http\Controllers\Front\FrontThamQuyenController;
use App\Http\Controllers\Front\FrontTieuChuanController;
use App\Http\Controllers\Front\ASKController;
use App\Http\Controllers\PhongBanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('test', function () {
//     echo 1;
// });
Route::middleware(['auth:sanctum', 'verified'])->group(
    function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');
        // User
        Route::resource('users', 'App\Http\Controllers\UserController');
        Route::get('/users-data', [App\Http\Controllers\UserController::class, 'anyData'])->name('getUsersData');
        Route::resource('roles', 'App\Http\Controllers\RoleController');

        //Role
        Route::resource('roles', 'App\Http\Controllers\RoleController');

        // Vị trí
        // Back-end
        Route::resource('dashboard/vi-tri','App\Http\Controllers\ViTriController')->parameters([
            'vi-tri' =>'vi-tri:id'
        ]);
        Route::get('/get-data-vi-tri',[FrontViTriController::class,'__getViTri']);

        // Front-end
        Route::get('front-vi-tri-lock/{id}',[FrontViTriController::class,'lockViTri'])->name('front-vi-tri.lock');
        Route::get('front-vi-tri-unlock/{id}',[FrontViTriController::class,'unlockViTri'])->name('front-vi-tri.unlock');
        Route::resource('front-vi-tri','App\Http\Controllers\Front\FrontViTriController')->parameters([
            'front-vi-tri' =>'vi-tri:id'
        ]);



        // Nhiệm vụ

       //  Back-end
        Route::resource('dashboard/nhiem-vu','App\Http\Controllers\NhiemVuController')->parameters([
            'nhiem-vu' =>'nhiem-vu:id'
        ]);
        Route::get('/get-data-trach-nhiem',[FrontNhiemVuController::class,'__getTrachNhiem']);

        // Front-end
        Route::put('/front-nhiem-vu/{id?}/update',[FrontNhiemVuController::class,'update'])->name('front-nhiem-vu.update');
        Route::delete('/front-nhiem-vu-delete/{id?}',[FrontNhiemVuController::class,'destroy']);
        Route::resource('front-nhiem-vu','App\Http\Controllers\Front\FrontNhiemVuController')->parameters([
            'front-nhiem-vu' =>'nhiem-vu:id'
        ])->except(['update','destroy']);

        // Mô tả nhiệm vụ

        // Back-end
        Route::resource('dashboard/mo-ta-nhiem-vu','App\Http\Controllers\MoTaNhiemVuController')->parameters([
            'mo-ta-nhiem-vu' =>'mo-ta-nhiem-vu:id'
        ]);
        Route::get('/get-data-mo-ta-trach-nhiem',[FrontMoTaNhiemVuController::class,'__getTrachNhiem']);

        // Front-end
        Route::put('front-mo-ta-nhiem-vu/{id}/update',[FrontMoTaNhiemVuController::class,'update']);
        Route::delete('front-mo-ta-nhiem-vu-delete/{id}',[FrontMoTaNhiemVuController::class,'destroy']);
        Route::resource('front-mo-ta-nhiem-vu','App\Http\Controllers\Front\FrontMoTaNhiemVuController')->parameters([
            'front-mo-ta-nhiem-vu' =>'mo-ta-nhiem-vu:id'
        ])->except(['update','destroy']);

        // Tiêu chuẩn tuyển chọn
    //    Back-end
        Route::resource('dashboard/tieu-chuan','App\Http\Controllers\TieuChuanTuyenChonController')->parameters([
            'tieu-chuan' =>'tieu-chuan:id'
        ]);
        Route::get('/get-data-tieu-chuan',[FrontTieuChuanController::class,'__getTieuChuan']);

        // Front-end
        Route::put('front-tieu-chuan/{id}/update',[FrontTieuChuanController::class,'update']);
        Route::resource('front-tieu-chuan','App\Http\Controllers\Front\FrontTieuChuanController')->parameters([
            'front-tieu-chuan' => 'tieu-chuan:id'
        ])->except(['update']);

        // Thẩm quyền
        // Back-end
        Route::resource('dashboard/tham-quyen','App\Http\Controllers\ThamQuyenController')->parameters([
            'tham-quyen' =>'tham-quyen:id'
        ]);

        Route::get('/get-data-tham-quyen',[FrontThamQuyenController::class,'__getThamQuyen']);

        // Front-end
        Route::put('front-tham-quyen/{id}/update',[FrontThamQuyenController::class,'update']);
        Route::delete('front-tham-quyen-delete/{id}',[FrontThamQuyenController::class,'destroy']);
        Route::resource('front-tham-quyen','App\Http\Controllers\Front\FrontThamQuyenController')->parameters([
            'front-tham-quyen' =>'tham-quyen:id'
        ])->except(['update','destroy']);

        // Quan hệ trong công việc
        // Back-end
        Route::resource('dashboard/quan-he','App\Http\Controllers\QuanHeController')->parameters([
            'quan-he' =>'quan-he:id'
        ]);

        // Front-End
        Route::get('/get-data-quan-he',[FrontQuanHeController::class,'__getQuanHe']);
        Route::put('front-quan-he/{id}/update',[FrontQuanHeController::class,'update']);
        Route::delete('front-quan-he-delete/{id}',[FrontQuanHeController::class,'destroy']);
        Route::resource('front-quan-he','App\Http\Controllers\Front\FrontQuanHeController')->parameters([
            'front-quan-he' =>'quan-he:id'
        ])->except(['update','destroy']);


        // Front-end
        // User
        Route::resource('front-user','App\Http\Controllers\Front\UserController')->parameters([
            'front-user' =>'user:id'
        ]);

        // ASK
        Route::put('front-ask/{id}/update',[ASKController::class,'update']);
        Route::delete('front-ask-delete/{id}',[ASKController::class,'destroy']);
        Route::get('/get-data-ask',[ASKController::class,'__getASK']);
        Route::resource('/front-ask','App\Http\Controllers\Front\ASKController')->except(['update','destroy']);;

        Route::get('getData-vi-tri',[FrontUserController::class,'getData'])->name('vi-tri.getData');
        Route::get('getData2-vi-tri',[FrontUserController::class,'getData2'])->name('vi-tri.getData2');
        Route::get('getData3-vi-tri',[FrontUserController::class,'getData3'])->name('vi-tri.getData3');

    Route::prefix('/vi-tri')->as('front.vi-tri.')->group(function(){
        Route::get('/{viTri}',[FrontViTriController::class,'show'])->name('show');
    });
    Route::get('/',[FrontUserController::class,'index']);
    Route::get('/giao-dien-2',[FrontUserController::class,'index2']);

    // Xử  lý phòng ban
    Route::resource('phong-ban','App\Http\Controllers\PhongBanController')->parameters([
        'phong-ban' => 'phong-ban:id'
    ]);
});
