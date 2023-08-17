<?php

use App\Http\Controllers\Competition\GroupController;
use App\Http\Controllers\Competition\MainController;
use App\Http\Controllers\Competition\MatchController;
use App\Http\Controllers\Competition\FinalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompetitionController;

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

// View
Route::get('/', function () {
    return redirect('/login');
});



// Auth
Route::get('/login', [AdminController::class, 'loginForm']);
Route::get('/logout', [AdminController::class, 'logout']);
Route::post('/auth', [AdminController::class, 'auth']);

// CompetitionController
Route::resource('/competitions', MainController::class);
Route::get('/competitions/{slug}/standing' , [GroupController::class , 'standing']);
Route::get('/competitions/{slug}/allocate-teams' , [GroupController::class , 'allocateTeams']);
Route::get('/competitions/{slug}/rollback-group' , [GroupController::class , 'rollbackGroup']);

// match
Route::get('/competitions/{slug}/match' , [MatchController::class , 'matches']);
Route::get('/competitions/{slug}/create-matches' , [MatchController::class , 'createMatches']);
Route::get('/competitions/{slug}/rollback-matches' , [MatchController::class , 'rollback']);

// Finals
Route::get('/competitions/{slug}/final' , [FinalController::class , 'index']);

