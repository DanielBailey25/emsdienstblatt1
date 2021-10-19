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

    Route::get('/warn/idle', [App\Http\Controllers\IdleWarnController::class, 'index'])->name('idleWarnIndex');
    Route::get('/warn/idle/seen', [App\Http\Controllers\IdleWarnController::class, 'markAsSeen'])->name('seenIdleWarn');

    Route::get('/start', [App\Http\Controllers\CurrentWorkerController::class, 'index'])->name('startWorker');
    Route::get('/status/change', [App\Http\Controllers\CurrentWorkerController::class, 'changeStatus'])->name('changeStatus');

    Route::get('/leaderboard', [App\Http\Controllers\LeadeboardController::class, 'index'])->name('leaderboard');

    Route::prefix('form')->group(function () {
        Route::post('/currentworker/start', [App\Http\Controllers\CurrentWorkerController::class, 'startWorker'])->name('formStartWorker');
        Route::get('/currentworker/stop', [App\Http\Controllers\CurrentWorkerController::class, 'stopWorker'])->name('formStopWorker');
        Route::post('/switchItemClosedState', [App\Http\Controllers\DashboardController::class, 'switchItemClosedState'])->name('switchItemClosedState');
        Route::post('/centerChangeAssignment', [App\Http\Controllers\DashboardController::class, 'centerChangeAssignment'])->name('centerChangeAssignment');
        Route::post('/absence', [App\Http\Controllers\AbsenceController::class, 'createAbsence'])->name('formCreateAbsence');
        Route::post('/user/change/password', [App\Http\Controllers\UserController::class, 'changePassword'])->name('changePassword');
        Route::post('/user/change/info', [App\Http\Controllers\UserController::class, 'changeInformation'])->name('changeInformation');
        Route::post('/user/change/role', [App\Http\Controllers\UserController::class, 'changeRole'])->name('changeRole');
    });

    Route::get('/notification/{id}/read', [App\Http\Controllers\DashboardController::class, 'markNotificationAsRead'])->name('notificationRead');

    Route::get('/workers', [App\Http\Controllers\WorkersController::class, 'index'])->name('workers');
    Route::get('/absence/add', [App\Http\Controllers\AbsenceController::class, 'showCreateAbsenceView'])->name('createAbsence');
    Route::get('/absence/{id}/delete', [App\Http\Controllers\AbsenceController::class, 'deleteAbsence'])->name('deleteAbsence');

    Route::prefix('information')->group(function () {
        Route::get('/absences', [App\Http\Controllers\AbsenceController::class, 'showAbsences'])->name('showAbsences');
        Route::get('/bans', [App\Http\Controllers\BansController::class, 'index'])->name('bans');
        Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('events');
        Route::get('/event/add', [App\Http\Controllers\EventController::class, 'createEventView'])->name('createEvent');
        Route::post('/event/add', [App\Http\Controllers\EventController::class, 'createEvent'])->name('createEvent');
        Route::get('/training/get/{id}', [App\Http\Controllers\TrainingsController::class, 'showTraining'])->name('training');
        Route::get('/news', [App\Http\Controllers\NewsController::class, 'index'])->name('news');
    });
    Route::group(['middleware' => ['role:Admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/users', [App\Http\Controllers\UserController::class, 'users'])->name('users');
            Route::get('/user/add', [App\Http\Controllers\UserController::class, 'addUserView'])->name('addUserView');
            Route::get('/user/{id}/rank/increase', [App\Http\Controllers\UserController::class, 'increaseRank'])->name('userIncreaseRank');
            Route::get('/user/{id}/rank/decrease', [App\Http\Controllers\UserController::class, 'decreaseRank'])->name('userDecreaseRank');
            Route::get('/user/{id}/remove', [App\Http\Controllers\UserController::class, 'removeUser'])->name('removeUser');

            Route::get('/warns', [App\Http\Controllers\WarnsController::class, 'show'])->name('showWarns');
            Route::get('/warns/delete/{id}', [App\Http\Controllers\WarnsController::class, 'delete'])->name('deleteWarn');
            Route::post('/warns/create', [App\Http\Controllers\WarnsController::class, 'create'])->name('createWarn');
            Route::get('/warns/create/{userId}', [App\Http\Controllers\WarnsController::class, 'showForm'])->name('showCreateWarnForm');

            Route::get('/currentworker/{id}/stop', [App\Http\Controllers\CurrentWorkerController::class, 'stopWorkerById'])->name('stopWorkerById');
            Route::get('/training/add', [App\Http\Controllers\TrainingsController::class, 'createTrainingView'])->name('createTraining');
            Route::post('/training/add', [App\Http\Controllers\TrainingsController::class, 'createTraining'])->name('createTraining');
            Route::post('/form/user/add', [App\Http\Controllers\UserController::class, 'createUser'])->name('createUserForm');
            Route::post('/form/add/user', [App\Http\Controllers\UserController::class, 'createUser'])->name('createUserForm');
        });
    });
    Route::group(['middleware' => ['role:Editor|Admin']], function () {
        Route::prefix('admin')->group(function () {
            Route::get('/training/unlock', [App\Http\Controllers\TrainingsController::class, 'unlockTrainingView'])->name('unlockTrainingView');
            Route::post('/training/unlock', [App\Http\Controllers\TrainingsController::class, 'unlockTrainingForUsers'])->name('unlockTrainingForUsers');
            Route::get('/news/add', [App\Http\Controllers\NewsController::class, 'addNewsView'])->name('addNews');
            Route::post('/news/add', [App\Http\Controllers\NewsController::class, 'addNews'])->name('addNews');
        });
    });

    Route::prefix('user')->group(function () {
        Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    });

});



