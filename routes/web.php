<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
php artisan migrate:fresh


*/


    Route::get('/', function () {
        return view('index');
    });


Route::get('/blank', function () {
    return view( 'blank');
})->name('blank');

Route::get('/section', function () {
    return view( 'section');
})->name('section');


Route::get('/buttons', function () {
    return view('buttons');
})->name('buttons');

Route::get('/cards', function () {
    return view( 'cards');
})->name('cards');

Route::get('/charts', function () {
    return view( 'charts');
})->name('charts');

Route::get('/', function () {
    return view('index');
})->name('index');

Route::get('/error', function () {
    return view('404');
})->name('error');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');














Route::get('/categoria', [CategoriaController::class, 'index'] )->name("categoria");



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
