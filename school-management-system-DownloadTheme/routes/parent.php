<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:parent' ]
    ], function(){
        
    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        return view('pages.parent_dashboard');
    });
    });