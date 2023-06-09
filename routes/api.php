<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;

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

// Importare apiResource e chi lo controlla-
Route::apiResource('projects', ProjectController::class)->except('store', 'update', 'destroy');

// Rotta Categorie
Route::get('/type/{type_id}/projects', [ProjectController::class, 'getProjectsByType']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
