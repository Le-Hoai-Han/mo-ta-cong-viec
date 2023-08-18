<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\front\UserController as FrontUserController;
use App\Http\Controllers\Front\ViTriController as FrontViTriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViTriController;

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
        Route::resource('dashboard/vi-tri','App\Http\Controllers\ViTriController')->parameters([
            'vi-tri' =>'vi-tri:id'
        ]);

        
        // Nhiệm vụ
        Route::resource('dashboard/nhiem-vu','App\Http\Controllers\NhiemVuController')->parameters([
            'nhiem-vu' =>'nhiem-vu:id'
        ]);
        
        // Mô tả nhiệm vụ
        Route::resource('dashboard/mo-ta-nhiem-vu','App\Http\Controllers\MoTaNhiemVuController')->parameters([
            'mo-ta-nhiem-vu' =>'mo-ta-nhiem-vu:id'
        ]);
        
        // Tiêu chuẩn tuyển chọn
        Route::resource('dashboard/tieu-chuan','App\Http\Controllers\TieuChuanTuyenChonController')->parameters([
            'tieu-chuan' =>'tieu-chuan:id'
        ]);
        
        // Thẩm quyền
        Route::resource('dashboard/tham-quyen','App\Http\Controllers\ThamQuyenController')->parameters([
            'tham-quyen' =>'tham-quyen:id'
        ]);
        
        // Quan hệ trong công việc
        Route::resource('dashboard/quan-he','App\Http\Controllers\QuanHeController')->parameters([
            'quan-he' =>'quan-he:id'
        ]);
        
        
        // Front-end
        // User
        Route::resource('front/user','App\Http\Controllers\Front\UserController')->parameters([
            'front/user' =>'user:id'
        ]);
        
        Route::get('getData-vi-tri',[FrontUserController::class,'getData'])->name('vi-tri.getData');

    Route::prefix('/vi-tri')->as('front.vi-tri.')->group(function(){
        Route::get('/{viTri}',[FrontViTriController::class,'show']);
    });    
    Route::get('/',[FrontUserController::class,'index']);
});