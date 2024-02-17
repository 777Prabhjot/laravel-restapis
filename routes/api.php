<?php

use Illuminate\Http\Request;
use App\Http\Controllers\VlogController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(VlogController::class)->group(function () {
    Route::get('/getVlogs','index');
    Route::post('/create','create');
    Route::put('/update/{id}','update');
    Route::delete('/delete/{id}','delete');
});