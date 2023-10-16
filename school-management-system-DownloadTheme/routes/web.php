<?php

use App\Http\Controllers\Classroom\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Sections\SectionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::group(['middleware'=>['guest']],function(){
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){
        Route::group(['namespace'=>'Grades'],function(){
            Route::get('/grades', [GradeController::class,'index'])->name('grades.index');
            Route::post('/grades-store', [GradeController::class,'store'])->name('grades.store');
            Route::post('/grades-update', [GradeController::class,'update'])->name('grades.update');
            Route::post('/grades-destroy', [GradeController::class,'destroy'])->name('grades.destroy');

        });

        Route::group(['namespace'=>'ClassRooms'],function(){
            Route::get('/classrooms', [ClassroomController::class,'index'])->name('classrooms.index');
            Route::post('/classrooms-store', [ClassroomController::class,'store'])->name('classrooms.store');
            Route::post('/classrooms-update', [ClassroomController::class,'update'])->name('classrooms.update');
            Route::post('/classrooms-delete', [ClassroomController::class,'delete'])->name('classrooms.delete');
            Route::post('/classrooms-delete-all', [ClassroomController::class,'deleteAll'])->name('classrooms.delete-all');
            Route::post('/classrooms-filter-classes', [ClassroomController::class,'filterClasses'])->name('classrooms.filter-classes');

         
        });

        Route::group(['namespace'=>'Sections'],function(){
            Route::get('/sections', [SectionController::class,'index'])->name('sections.index');
            Route::post('/sections-store', [SectionController::class,'store'])->name('sections.store');
            Route::get('/classes/{id}', [SectionController::class,'getClasses'])->name('sections.getClasses');
            Route::post('/sections-update', [SectionController::class,'update'])->name('sections.update');
            Route::post('/sections-delete', [SectionController::class,'delete'])->name('sections.delete');

            
        });

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    });


// Route::get('/home', 'HomeController@index')->name('home');
