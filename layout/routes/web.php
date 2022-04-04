<?php

use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use function PHPUnit\Framework\returnSelf;

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

// ログイン・汎用系
Route::get('/', function () {
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});
Route::get('first_login', [LoginController::class, 'getFirstLogin'])->name('getFirstLogin');
Route::post('first_login', [LoginController::class, 'postFirstLogin'])->name('postFirstLogin');
Route::get('/exception', function () {
    return view('errors.exception');
})->name('exception');
Route::group(['middleware' => ['guest:web']], function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    $limiter = config('fortify.limiters.login');
    $twoFactorLimiter = config('fortify.limiters.two-factor');
    $verificationLimiter = config('fortify.limiters.verification', '6,1');
    Route::post('/login', [LoginController::class, 'postLogin'])
        ->middleware(array_filter([
            'guest:' . config('fortify.guard'),
            $limiter ? 'throttle:' . $limiter : null,
        ]));

    Route::get('two_factor_auth', [LoginController::class, 'getTwoFactorAuth'])->name('getTwoFactorAuth');
    Route::post('two_factor_auth', [LoginController::class, 'postTwoFactorAuth'])->name('postTwoFactorAuth');
});

// 画面
Route::group(['middleware' => ['auth:web']], function () {
    Route::get('home', function () {
        return view('home');
    })->name('home');
    Route::post('/logout', [LoginController::class, 'destroy'])
        ->name('logout');
    // スタッフ管理
    Route::group(['prefix' => 'staff', 'middleware' => ['privileges:staff']], function () {
        Route::get('/', [StaffController::class, 'getStaff'])->name('getStaff');
        Route::post('/', [StaffController::class, 'postStaff'])->name('postStaff');
        Route::post('/search', [StaffController::class, 'postStaffSearch'])->name('postStaffSearch');
        Route::get('/create', [StaffController::class, 'getStaffCreate'])->name('getStaffCreate');
        Route::post('/create', [StaffController::class, 'postStaffCreate'])->name('postStaffCreate');
        Route::get('/detail/{id}', [StaffController::class, 'getStaffDetail'])->name('getStaffDetail');
        Route::get('/edit/{id}', [StaffController::class, 'getStaffEdit'])->name('getStaffEdit');
        Route::post('/edit', [StaffController::class, 'postStaffEdit'])->name('postStaffEdit');
    });
    // アナリティクス管理
    Route::group(['prefix' => 'analytics', 'middleware' => ['privileges:analytics']], function () {
        Route::get('/', [AnalyticsController::class, 'getAnalytics'])->name('getAnalytics');
        Route::post('/', [AnalyticsController::class, 'postAnalytics'])->name('postAnalytics');
        Route::get('/summary', [AnalyticsController::class, 'getAnalyticsSummary'])->name('getAnalyticsSummary');
        Route::get('/transition', [AnalyticsController::class, 'getAnalyticsTransition'])->name('getAnalyticsTransition');
        Route::get('/gender', [AnalyticsController::class, 'getAnalyticsGender'])->name('getAnalyticsGender');
        Route::get('/age', [AnalyticsController::class, 'getAnalyticsAge'])->name('getAnalyticsAge');
        Route::get('/eria', [AnalyticsController::class, 'getAnalyticsEria'])->name('getAnalyticsEria');
    });
});
