<?php

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

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('home');
    } else {
        return redirect('login');
    }
});

Route::middleware(['auth:sanctum', 'verified'])->get('/home', function () {
    return view('home');
})->name('home');

Route::post('two_factor_auth', [LoginController::class, 'twoFactorAuth'])->name('twoFactorAuth');

Route::group(['middleware' => ['auth:web']], function () {
    Route::get('/exception', function () {
        return view('errors.exception');
    })->name('exception');
    Route::group(['prefix' => 'staff'], function () {
        Route::get('/', [StaffController::class, 'getStaff'])->name('getStaff');
        Route::post('/', [StaffController::class, 'postStaff'])->name('postStaff');
        Route::post('/search', [StaffController::class, 'postStaffSearch'])->name('postStaffSearch');
        Route::get('/create', [StaffController::class, 'getStaffCreate'])->name('getStaffCreate');
        Route::post('/create', [StaffController::class, 'postStaffCreate'])->name('postStaffCreate');
        Route::get('/detail/{id}', [StaffController::class, 'getStaffDetail'])->name('getStaffDetail');
        Route::get('/edit/{id}', [StaffController::class, 'getStaffEdit'])->name('getStaffEdit');
        Route::post('/edit', [StaffController::class, 'postStaffEdit'])->name('postStaffEdit');
    });
});
