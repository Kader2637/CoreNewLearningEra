<?php

use Illuminate\Support\Facades\Route;


Route::get('/about', function () {
    return view('pages.LandingPage.about.index');
});
Route::get('/classroom', function () {
    return view('pages.LandingPage.classroom.index');
});
