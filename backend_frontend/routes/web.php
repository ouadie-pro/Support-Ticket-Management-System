<?php

use Illuminate\Support\Facades\Route;


Route::get('/home',function(){
    return view('Home');
});

Route::get('/', function () {
    return view('welcome');
});
