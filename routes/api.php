<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\NewsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);
    Route::post('/updatePassword', [App\Http\Controllers\API\AuthController::class, 'updatePassword']);
});

Route::get('/allUser', [App\Http\Controllers\API\AuthController::class, 'AllUsers']);

Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);

Route::get('/allNews', [App\Http\Controllers\API\NewsController::class, 'index']);

Route::get('/news/{id}', [App\Http\Controllers\API\NewsController::class, 'show']);

Route::get('/Category', [\App\Http\Controllers\API\CategoryController::class, 'index']);

Route::get('/category/{id}', [App\Http\Controllers\API\NewsController::class, 'show']);

Route::get('/Carosel', [\App\Http\Controllers\API\FrontEndController::class, 'index']);

