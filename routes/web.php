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

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('home');

    Route::get('/start', [App\Http\Controllers\CurrentWorkerController::class, 'index'])->name('startWorker');

    Route::prefix('form')->group(function () {
        Route::post('/start', [App\Http\Controllers\CurrentWorkerController::class, 'startWorker'])->name('formStartWorker');
        Route::get('/stop', [App\Http\Controllers\CurrentWorkerController::class, 'stopWorker'])->name('formStopWorker');
        Route::post('/switchItemClosedState', [App\Http\Controllers\DashboardController::class, 'switchItemClosedState'])->name('switchItemClosedState');
        Route::post('/centerChangeAssignment', [App\Http\Controllers\DashboardController::class, 'centerChangeAssignment'])->name('centerChangeAssignment');
        Route::post('/absence', [App\Http\Controllers\AbsenceController::class, 'createAbsence'])->name('formCreateAbsence');
    });

    Route::get('/workers', [App\Http\Controllers\WorkersController::class, 'index'])->name('workers');
    Route::get('/create/absence', [App\Http\Controllers\AbsenceController::class, 'showCreateAbsenceView'])->name('createAbsence');

    Route::prefix('information')->group(function () {
        Route::get('/absences', [App\Http\Controllers\AbsenceController::class, 'showAbsences'])->name('showAbsences');
        Route::get('/bans', [App\Http\Controllers\BansController::class, 'index'])->name('bans');
        Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events');
        Route::get('/add/events', [App\Http\Controllers\EventController::class, 'createEventView'])->name('createEvent');
        Route::post('/add/events', [App\Http\Controllers\EventController::class, 'createEvent'])->name('createEvent');
        // Route::get('/absences', [App\Http\Controllers\AbsenceController::class, 'showAbsences'])->name('showAbsences');
        Route::get('/interns', [App\Http\Controllers\WorkersController::class, 'showInterns'])->name('interns');
        Route::post('/interns', [App\Http\Controllers\CurrentWorkerController::class, 'startWorkerForInterns'])->name('interns');
        Route::get('/training/{id}', [App\Http\Controllers\TrainingsController::class, 'showTraining'])->name('training');
        Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
        Route::get('/nordmap', [App\Http\Controllers\NordmapController::class, 'index'])->name('nordmap');
    });
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/users', [App\Http\Controllers\UserController::class, 'users'])->name('users');
            Route::get('/add/user', [App\Http\Controllers\UserController::class, 'addUserView'])->name('addUserView');
            Route::get('/add/training', [App\Http\Controllers\TrainingsController::class, 'createTrainingView'])->name('createTraining');
            Route::post('/add/training', [App\Http\Controllers\TrainingsController::class, 'createTraining'])->name('createTraining');
            Route::post('/form/add/user', [App\Http\Controllers\UserController::class, 'createUser'])->name('createUserForm');
        });
    });
    Route::group(['middleware' => ['role:Editor|Admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/unlock/training', [App\Http\Controllers\TrainingsController::class, 'unlockTrainingView'])->name('unlockTrainingView');
            Route::post('/unlock/training', [App\Http\Controllers\TrainingsController::class, 'unlockTrainingForUsers'])->name('unlockTrainingForUsers');
            Route::get('/add/news', [App\Http\Controllers\NewsController::class, 'addNewsView'])->name('addNews');
            Route::post('/add/news', [App\Http\Controllers\NewsController::class, 'addNews'])->name('addNews');
        });
    });

    Route::prefix('user')->group(function () {
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    });

});



