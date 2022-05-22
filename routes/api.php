<?php
declare(strict_types=1);

use App\Http\Controllers\Api\MeController;
use App\Http\Controllers\Api\TargetController;
use App\Http\Controllers\Api\UserController;
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

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', MeController::class);
    Route::post('/target', [TargetController::class, 'register'])->name('register');
    Route::group(['prefix' => 'target', 'as' => 'target.'], function () {
        Route::get('index', [TargetController::class, 'index'])->name('index');
    });
});

Route::post('/user', [UserController::class, 'create']);
