<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('pages.LandingPage.index');
});

Route::get('/classroom', function () {
    return view('pages.LandingPage.classroom.index');
});

Route::get('/about', function () {
    return view('pages.LandingPage.about.index');
});
