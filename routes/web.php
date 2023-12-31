<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Get ======================================================

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/data', [DataController::class, 'showForm'])->name('show-form');

Route::get('/show-data', [DataController::class, 'showData'])->name('show-data');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');

//Post =====================================================

Route::post('/clear-session', [DataController::class, 'clearSession'])->name('clear-session');

Route::post('/submit-form', [DataController::class, 'handleSubmit'])->name('submit-form');

Route::post('/add-user', [UserController::class, "addUser"])->name("add-user");

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//
