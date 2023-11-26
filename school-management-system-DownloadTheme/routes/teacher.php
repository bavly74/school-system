<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teachers\TeacherController;
use App\Teacher;
use App\Student;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {
       // $count_sections=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id')->count();
         $ids = Teacher::findorFail(auth()->user()->id)->sections()->pluck('section_id');
         $count_sections=$ids->count();
         $count_students=Student::whereIn('section_id',$ids)->count();

        return view('pages.teachers.dashboard',['count_sections'=>$count_sections,'count_students'=>$count_students]);
    });

    Route::group(['namespace'=>'Teacher'],function(){
        Route::get('/students-list', [TeacherController::class,'getStudents'])->name('students-list.index');
        Route::get('/sections-list', [TeacherController::class,'getSections'])->name('sections-list.index');

    });

});