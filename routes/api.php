<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\DonorController;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Route::post('login', [ApiController::class, 'login'])->name('api.login');
Route::post('register', [ApiController::class, 'register'])->name('api.register');
Route::get('getPeople', [ApiController::class, 'getPeople'])->name('api.getPeople')->middleware('auth:sanctum');
Route::get('logout', [ApiController::class, 'logout'])->name('api.logout')->middleware('auth:sanctum');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('divisions', [DonorController::class, 'getDivisions'])->name('api.divisions');
Route::get('districts/{divisionId}', [DonorController::class, 'getDistricts'])->name('api.districts');
Route::get('upazilas/{districtId}', [DonorController::class, 'getUpazilas'])->name('api.upazilas');
Route::get('unions/{upazilaId}', [DonorController::class, 'getUnions'])->name('api.unions');
Route::post('/donor', [DonorController::class, 'store'])->name('api.donor.store');
