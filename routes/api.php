<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('login', [ApiController::class, 'login'])->name('api.login');
Route::post('register', [ApiController::class, 'register'])->name('api.register');
Route::get('getPeople', [ApiController::class, 'getPeople'])->name('api.getPeople')->middleware('auth:sanctum');
Route::get('logout', [ApiController::class, 'logout'])->name('api.logout')->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
