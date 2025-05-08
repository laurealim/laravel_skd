<?php

use App\Models\Person;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PersonController;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

//Route::get('/web', function () {
//    return Inertia::render('Webpage',[
//        'logoUrl' => asset('images/hero.png'),
//        'logo' => asset('images/blood-donation.png'),
//        'bgSlider' => asset('images/1.jpg'),
//    ]);
//})->name('web');

Route::get('/web', [PersonController::class,'home'])->name('home');
Route::get('/about', [PersonController::class,'about'])->name('about');
Route::get('/contact', [PersonController::class,'contact'])->name('contact');

Route::get('dashboard', function () {
    $people = Person::all();
    return Inertia::render('Dashboard',['people' => $people]);
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
// require __DIR__.'/api.php';
