<?php

use App\Http\Controllers\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\Teacher\AccountSetting;
use App\Http\Controllers\Teacher\HomeController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Teacher\ScanQrController;
use App\Http\Controllers\Admin\ServerComController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Teacher\AbsensiController;
use App\Http\Controllers\Teacher\ActivityController;
use App\Http\Controllers\Admin\DetailAbsensiController;
use App\Http\Controllers\Admin\ReportAbsensiController;
use App\Http\Controllers\Teacher\ManualAbsensiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;

Route::prefix('/admin')->group(function () {

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
                    ->middleware('guest')
                    ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store'])
                    ->middleware('guest');

    Route::get('google', [GoogleAuthController::class, 'redirect'])->name('google');


    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

    Route::get('petunjuk', [GuideController::class, 'index'])->name('guide');

    Route::middleware(['check_auth:admin'])->group(function () {
        Route::get('home', [HomeController::class, 'index'])->name('teacher.home');

        Route::as('admin.')->group(function () {
            Route::get('/', [AdminAbsensiController::class, 'index'])->name('index');
            Route::prefix('absensi')->as('absensi.')->group(function () {
                Route::any('/datas/absensi', [AdminAbsensiController::class, 'loadData'])->name('load.data');
                Route::get('/detail/{absensi}', [DetailAbsensiController::class, 'index'])->name('detail');
                Route::get('/report', [ReportAbsensiController::class, 'index'])->name('report');
            });

            Route::resource('absensi', AdminAbsensiController::class);
            Route::get('teacher/datatable', [TeacherController::class, 'loadData'])->name('teacher.datatable');
            Route::get('teacher/activity/{teacher_id}', [TeacherController::class, 'timeLine'])->name('teacher.activity');
            Route::resource('teacher', TeacherController::class);

            Route::get('serverCom/datatable', [ServerComController::class, 'loadData'])->name('serverCom.datatable');
            Route::resource('serverCom', ServerComController::class);
        });
    });


});


Route::prefix('teacher')->as('teacher.')->group(function () {
    Route::prefix('absensi')->as('absensi.')->group(function () {
        Route::get('scan-qr', [ScanQrController::class, 'index'])->name('scan');
        Route::get('scan', [ScanQrController::class, 'store'])->name('scan2');
        Route::get('daftar', [AbsensiController::class, 'index'])->name('index');
        Route::post('daftar', [AbsensiController::class, 'searchDate'])->name('search');
    });

    Route::prefix('account')->as('account.')->group(function () {
        Route::get('password', [AccountSetting::class, 'index_password'])->name('password');
        Route::post('password', [AccountSetting::class, 'update_password']);
    });

    Route::prefix('activity')->as('activity.')->group(function () {
        Route::post('/getData', [ActivityController::class, 'getData'])->name('get-data');
    });
    Route::resource('activity', ActivityController::class);
    Route::resource('manual', ManualAbsensiController::class);
});
