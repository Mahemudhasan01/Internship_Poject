<?php

use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware;
 

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
    return view('login');
});
Route::post('login', [RegistrationController::class, 'login'])->name('login');
Route::post('register', [RegistrationController::class, 'register'])->name('sinup');
Route::get('logout', [RegistrationController::class, 'logout'])->name('logout');
Route::get('Forgot', [RegistrationController::class, 'forgot'])->name('user.forgot');
Route::post('sendForgotEmail', [RegistrationController::class, 'sendForgotEmail'])->name('user.send.email');
Route::get('restpassword', [RegistrationController::class, 'sendOnRestPage'])->name('admin.reset.password');
Route::post('restpassword', [RegistrationController::class, 'resetPassword'])->name('admin.reset.info');

Route::get('users', [RegistrationController::class, 'index'])->middleware('CheckLogin')->name('user');