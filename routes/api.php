<?php

use App\Http\Controllers\api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\CompetitionController;
use App\Http\Controllers\api\TeamController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('/v1')->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'login']);

    // Competition
    Route::middleware(['tokenCheck'])->group(function () {
        Route::get('/competitions', [CompetitionController::class, 'all']);
        Route::get('competitions/{slug}' ,[CompetitionController::class , 'detail']);
        Route::post('/competitions/{slug}/register', [CompetitionController::class, 'register']);

        Route::get('teams/{code}', [TeamController::class, 'profile']);
        Route::get('teams/{code}/matches', [TeamController::class, 'matches']);
    });
});
