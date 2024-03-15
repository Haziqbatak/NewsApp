<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Profile\ProfileController;

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
    return view('welcome');
});

Auth::routes();

// handle redirect register to login
// Route::match(['get','post'], '/register', function(){
//     return redirect('/login');
// });

// Route for News using Resource
Route::resource('news', NewsController::class);

// route middleware
Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/changePassword', [ProfileController::class, 'changePassword'])->name('profile.changePassword');
    Route::put('/updatePassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    // route for admin
    Route::middleware(['auth','admin'])->group(function(){
        // route for Category using Resource
        Route::resource('category', CategoryController::class)->except('show');
        Route::get('/allUser', [ProfileController::class, 'allUser'])->name('allUser');
        Route::put('/resetPassword/{id}', [ProfileController::class, 'resetPassword'])->name('resetPassword');
    });

    Route::get('/createProfile', [ProfileController::class, 'createProfile'])->name('createProfile');
    Route::post('/storeProfile', [ProfileController::class, 'storeProfile'])->name('storeProfile');
    Route::get('/editProfile', [ProfileController::class, 'editProfile'])->name('editProfile');

});

