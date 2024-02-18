<?php

use Illuminate\Http\Request;
use App\Http\Controllers\VlogController;
use App\Http\Controllers\UserController;
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



Route::middleware('auth:api')->group(function () {
    Route::resource('vlogs', VlogController::class);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');

Route::controller(VlogController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/create', 'create');
    Route::patch('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'delete');
});
