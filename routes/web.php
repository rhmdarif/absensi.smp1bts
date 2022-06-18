<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teacher\HomeController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Teacher\ScanQrController;
use App\Http\Controllers\Admin\ServerComController;
use App\Http\Controllers\QrServer\ShowQrController;
use App\Http\Controllers\Teacher\AbsensiController;
use App\Http\Controllers\Teacher\ActivityController;
use App\Http\Controllers\Admin\DetailAbsensiController;
use App\Http\Controllers\Admin\ReportAbsensiController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensiController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\ImportDataGuruController;
use App\Http\Controllers\SchedullerController;
use App\Http\Controllers\Teacher\AccountSetting;
use App\Http\Controllers\Teacher\ManualAbsensiController;

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

Route::get('/', function () {
    return redirect()->route('teacher.home');
});

Route::get('phpinfo', function () {
    phpinfo();
});

Route::prefix('server')->group(function () {
    Route::get('show-qr', [ShowQrController::class, 'index'])->name('server.qr.show');
    Route::get('get-absen', [ShowQrController::class, 'getAbsen'])->name('server.get.absen');
    Route::get('reload-qr', [ShowQrController::class, 'reloadQr'])->name('server.qr.reload');
    Route::post("validation/komputer", [ShowQrController::class, "checkServer"])->name('server.server.validation');
    Route::post("validation", [ShowQrController::class, "updatePicture"])->name('server.qr.validation');
});

Route::prefix('callback')->group(function () {
    Route::any('google', [GoogleAuthController::class, 'callback'])->name('callback.google');
    Route::any('scheduller', [SchedullerController::class, 'task'])->name('callback.scheduller');
});
require __DIR__.'/user.php';
require __DIR__.'/admin.php';
