<?php

use App\Http\Controllers\Students\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student' ]
    ], function(){
    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        return view('pages.students.dashboard');
    });

    Route::group(['namespace'=>'Student'],function(){
       Route::get('student-quizzes',[StudentController::class,'getAllQuizzes'])->name('student-quizzes.index');

        Route::get('student-quizzes-show/{id}',[StudentController::class,'showQuiz'])->name('student-quizzes-show.show');
        Route::get('student-profile',[StudentController::class,'showProfile'])->name('student-profile.index');
        Route::post('student-profile/{id}',[StudentController::class,'updateProfile'])->name('student-profile.update');




    });

    });
