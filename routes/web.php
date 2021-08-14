<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();
Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

    Route::get('/start', [App\Http\Controllers\CurrentWorkerController::class, 'index'])->name('startWorker');

    Route::prefix('form')->group(function () {
        Route::post('/start', [App\Http\Controllers\CurrentWorkerController::class, 'startWorker'])->name('formStartWorker');
        Route::get('/stop', [App\Http\Controllers\CurrentWorkerController::class, 'stopWorker'])->name('formStopWorker');
        Route::post('/switchItemClosedState', [App\Http\Controllers\DashboardController::class, 'switchItemClosedState'])->name('switchItemClosedState');
    });

    Route::get('/workers', [App\Http\Controllers\WorkersController::class, 'index'])->name('workers');

    Route::prefix('information')->group(function () {
        Route::get('/absences', [App\Http\Controllers\AbsencesController::class, 'index'])->name('absences');
        Route::get('/bans', [App\Http\Controllers\BansController::class, 'index'])->name('bans');
        Route::get('/events', [App\Http\Controllers\EventsController::class, 'index'])->name('events');
        Route::get('/exemptions', [App\Http\Controllers\ExemptionsController::class, 'index'])->name('exemptions');
        Route::get('/interns', [App\Http\Controllers\InternsController::class, 'index'])->name('interns');
        Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
        Route::get('/nordmap', [App\Http\Controllers\NordmapController::class, 'index'])->name('nordmap');
    });

});



