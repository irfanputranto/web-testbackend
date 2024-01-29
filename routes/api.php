<?php

use App\Http\Controllers\api\ArticleController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\BusinessController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/business/search', [BusinessController::class, 'index']);
Route::post('/business', [BusinessController::class, 'store']);
Route::put('/business/{id}', [BusinessController::class, 'update']);
Route::delete('/business/{id}', [BusinessController::class, 'destroy']);

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
    Route::get('user', 'user');
});

Route::controller(ArticleController::class)->group(function () {
    Route::post('article', 'store');
    Route::get('article', 'index');
    Route::get('article/{identifier}', 'show');
});
