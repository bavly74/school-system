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
        Route::get('/sections-list',  [TeacherController::class,'getTeacherSections'])->name('sections-list.index');
        Route::post('/attendance',     [TeacherController::class,'attendance'])->name('attendance');
        Route::get('/attendance-report', [TeacherController::class,'attendanceReport'])->name('attendance.report');
        Route::post('/attendance-search',  [TeacherController::class,'attendanceSearch'])->name('attendance.search');
        Route::get('/teacher-quizzes',       [TeacherController::class,'quizzes'])->name('teacher-quizzes.index');
        Route::get('/teacher-quizzes-create',  [TeacherController::class,'createQuiz'])->name('teacher-quizzes.create');
        Route::get('/teacher-quizzes-edit/{id}',[TeacherController::class,'editQuiz'])->name('teacher-quizzes.edit');
        Route::post('/teacher-quizzes-update',[TeacherController::class,'updateQuiz'])->name('teacher-quizzes.update');
        Route::post('/teacher-quizzes-store',[TeacherController::class,'storeQuiz'])->name('teacher-quizzes.store');
        Route::get('/teacher-quizzes-delete/{id}',[TeacherController::class,'deleteQuiz'])->name('teacher-quizzes.delete');
        Route::get('/Get_classrooms/{id}',[TeacherController::class,'getClassrooms']);
        Route::get('/Get_Sections/{id}',[TeacherController::class,'Get_Sections']);
    });

});