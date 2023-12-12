<?php

use App\Http\Controllers\Parent\ParentDashboardController;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:parent' ]
    ], function(){

    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        $sons=Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.parent_dashboard',['sons'=>$sons]);
    });

    Route::group(['namespace'=>'Parent'],function(){
        Route::get('sons',[ParentDashboardController::class,'index'])->name('sons.index');
        Route::get('son-results/{id}',[ParentDashboardController::class,'getResults'])->name('son.results');
        Route::get('son-attendance',[ParentDashboardController::class,'attendance'])->name('sons.attendance');
        Route::post('son-attendance-search',[ParentDashboardController::class,'SearchAttendance'])->name('sons.attendance.search');
        Route::get('son-attendance-fees',[ParentDashboardController::class,'fees'])->name('sons.fees');
        Route::get('son-attendance-receipt/{id}',[ParentDashboardController::class,'receipt'])->name('sons.receipt');

        Route::get('parent-profile',[ParentDashboardController::class,'showProfile'])->name('parent-profile.index');
        Route::post('parent-profile-update/{id}',[ParentDashboardController::class,'updateProfile'])->name('parent-profile.update');



    });
    });
