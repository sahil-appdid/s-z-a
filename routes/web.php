<?php

namespace App;

use App\Http\Controllers\admin\AttendanceController;
use App\Http\Controllers\Admin\BatchController;
use App\Http\Controllers\Admin\LinkController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\admin\ZoomController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.students.index');
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout-admin');
});

Route::prefix('admin')->name('admin.')->middleware(['admin'])->group(function () {

    //     Route::name('home.')->controller(DashboardController::class)->group(function () {
    //         Route::get('/', 'home')->name('index');
    //         Route::get('invoice-download', 'downloadPdf')->name('invoice-download');
    //     });

    Route::name('students.')
        ->prefix('students')
        ->controller(StudentController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('blocked', 'index')->name('blocked');
            Route::get('deleted', 'index')->name('deleted');
            Route::post('store', 'store')->name('store');
            Route::get('{id}/edit', "edit")->name('edit');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('update', 'update')->name('update');
            Route::put('status', 'status')->name('status');
        });

    Route::name('batches.')
        ->prefix('batches')
        ->controller(BatchController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::post('store', 'store')->name('store');
            Route::get('{id}/edit', "edit")->name('edit');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('update', 'update')->name('update');
        });

    Route::name('subjects.')
        ->prefix('subjects')
        ->controller(SubjectController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('blocked', 'index')->name('blocked');
            Route::get('deleted', 'index')->name('deleted');
            Route::post('store', 'store')->name('store');
            Route::get('{id}/edit', "edit")->name('edit');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('update', 'update')->name('update');
            Route::put('status', 'status')->name('status');
        });

    Route::name('zooms.')
        ->prefix('zooms')
        ->controller(ZoomController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('blocked', 'index')->name('blocked');
            Route::get('deleted', 'index')->name('deleted');
            Route::post('store', 'store')->name('store');
            Route::get('{id}/edit', "edit")->name('edit');
            Route::delete('/{id}', 'destroy')->name('destroy');
            Route::post('update', 'update')->name('update');
            Route::put('status', 'status')->name('status');
        });

    Route::name('attendances.')
        ->prefix('attendances')
        ->controller(AttendanceController::class)->group(function () {
            Route::get('/', 'index')->name('index');
        });
});

Route::name('link.')->prefix('link')->controller(LinkController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('dompdf', 'dompdf')->name('dompdf');
    Route::get('browserpdf', 'browserpdf')->name('browserpdf');
});

Route::get('/zoom-link', [AttendanceController::class, 'store']);
