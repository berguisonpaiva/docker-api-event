<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EventController,
    InscriptionController,
    AuthController,
};

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


Route::get('events/inscriptions', [EventController::class, 'getEventInscriptionsWithFilter']);
Route::get('events', [EventController::class, 'index']);
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);
Route::post('refresh', [AuthController::class, 'refresh']);
Route::group(['middleware' => ['api', 'auth:api']], function () {
    Route::post('me', [AuthController::class, 'me']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('inscription', [InscriptionController::class, 'store']);
    Route::delete('inscription/{id}', [InscriptionController::class, 'destroy']);
});
