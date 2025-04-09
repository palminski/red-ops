<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AchievementController;
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



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');


// Movie Rating Routes
Route::get('/movie-queue', [MovieController::class, 'index'])->name('movie-queue');
Route::prefix('/movies')->group(function () {
    Route::get('/{id}', [MovieController::class, 'show'])->name('movies.show');
    Route::middleware(['auth'])->group(function () {
        Route::post('/{id}/rate', [MovieController::class, 'rate'])->name('movies.rate');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::post('/pick-movie', [MovieController::class, 'pickMovie'])->name('movie.pick');
});

// User Routes
Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('users.index');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');

    Route::middleware(['auth'])->group(function () {
        Route::post('/profile-pic/{id}', [UserController::class, 'updateProfilePicture'])->name('users.picture.update');
    });
});



Route::middleware(['auth'])->group(function () {
    Route::prefix('/admin')->middleware(['admin'])->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/show-user/{id}', [AdminController::class, 'showUser'])->name('admin.showUser');
        Route::post('/update-user/{id}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    });

    

    Route::prefix('/achievement')->group(function () {
        Route::post('/create', [AchievementController::class, 'create'])->name('achievement.create');
        Route::post('/assign/{id}', [AchievementController::class, 'assign'])->name('achievement.assign');
    });

    Route::prefix('/testing')->group(function () {
        Route::get('/', [TestingController::class, 'index'])->name('testing');
    });
});

//Testing
Route::middleware(['auth'])->group(function () {
    Route::get('/data', [TestingController::class, 'showForm'])->name('show-form');
    Route::get('/show-data', [TestingController::class, 'showData'])->name('show-data');
});


Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//
Route::post('/clear-session', [TestingController::class, 'clearSession'])->name('clear-session');
Route::post('/submit-form', [TestingController::class, 'handleSubmit'])->name('submit-form');
Route::post('/add-user', [UserController::class, "addUser"])->name("add-user");
