<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Integration\IntegrationController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('user')->group(function () {
    Route::post('/', [AuthController::class, 'signUp']);
});

Route::prefix('/integration')->group(function () {
   Route::get('/', [IntegrationController::class, 'index']);
});
