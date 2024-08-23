<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view("principal.index");
});



Route::get('produtos/', function () {
    return view('produto.lista');
});


Route::get('/', function () {
    return view('welcome');
});
