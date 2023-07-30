<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    EventController,
    InscriptionController,
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

Route::get('events',[EventController::class, 'index'] );
Route::get('events/inscriptions',[EventController::class, 'getEventInscriptionsWithFilter'] );
Route::post('inscription',[InscriptionController::class, 'store'] );
Route::delete('inscription/{id}',[InscriptionController::class, 'destroy'] );
