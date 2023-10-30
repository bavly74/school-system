<?php

use App\Http\Controllers\Classroom\ClassroomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\FeeInvoiceController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\GraduatesController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\ReceiptStudentController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Teachers\TeacherController;
use App\ProcessingFee;
use App\ReceiptStudent;

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

        Route::group(['namespace'=>'Teachers'],function(){
            Route::get('/teachers', [TeacherController::class,'index'])->name('teachers.index');
            Route::get('/teachers-create', [TeacherController::class,'create'])->name('teachers.create');
            Route::post('/teachers-store', [TeacherController::class,'store'])->name('teachers.store');
            Route::get('/teachers-edit/{id}', [TeacherController::class,'edit'])->name('teachers.edit');
            Route::post('/teachers-update', [TeacherController::class,'update'])->name('teachers.update');
            Route::post('/teachers-delete', [TeacherController::class,'delete'])->name('teachers.delete');

        });

        Route::group(['namespace'=>'Students'],function(){
            Route::get('/students', [StudentController::class,'index'])->name('students.index');
            Route::get('/students-create', [StudentController::class,'create'])->name('students.create');
            Route::post('/students-store', [StudentController::class,'store'])->name('students.store');
            Route::get('/Get_classrooms/{id}', [StudentController::class,'getClassrooms']);
            Route::get('/Get_Sections/{id}', [StudentController::class,'getSections']);
            Route::get('/students-show/{id}', [StudentController::class,'show'])->name('students.show');
            Route::get('/students-edit/{id}', [StudentController::class,'edit'])->name('students.edit');
            Route::post('/students-update', [StudentController::class,'update'])->name('students.update');
            Route::post('/students-upload_attachment', [StudentController::class,'upload_attachment'])->name('students.upload_attachment');
            Route::get('/Download_attachment/{studentName}/{fileName}', [StudentController::class,'Download_attachment'])->name('students.Download_attachment');
            Route::post('/students-delete_attachment', [StudentController::class,'deleteAttachment'])->name('students.delete_attachment');
            Route::post('/students-delete/{id}', [StudentController::class,'delete'])->name('students.delete');
            Route::get('/students-graduate/{id}', [StudentController::class,'graduate'])->name('students.graduate');

            Route::get('/promotions', [PromotionController::class,'index'])->name('promotions.index');
            Route::post('/promotions-store', [PromotionController::class,'store'])->name('promotions.store');
            Route::get('/promotions-management', [PromotionController::class,'create'])->name('promotions.create');
            Route::post ('/promotions-management-delete-all', [PromotionController::class,'destroy'])->name('promotions.destroy');

            Route::get('/graduated', [GraduatesController::class,'index'])->name('graduated.index');
            Route::get('/graduated-create', [GraduatesController::class,'create'])->name('graduated.create');
            Route::post('/graduated-store', [GraduatesController::class,'store'])->name('graduated.store');
            Route::post('/graduated-update', [GraduatesController::class,'update'])->name('graduated.update');
            Route::post('/graduated-destroy', [GraduatesController::class,'destroy'])->name('graduated.destroy');

            Route::get('/fees', [FeesController::class,'index'])->name('fees.index');
            Route::get('/fees-create', [FeesController::class,'create'])->name('fees.create');
            Route::post('/fees-store', [FeesController::class,'store'])->name('fees.store');
            Route::get('/fees-edit/{id}', [FeesController::class,'edit'])->name('fees.edit');
            Route::post('/fees-update', [FeesController::class,'update'])->name('fees.update');
            Route::post('/fees-destroy', [FeesController::class,'destroy'])->name('fees.destroy');
            Route::get('/fees-show/{id}', [FeesController::class,'show'])->name('fees.show');

            Route::get('/fees-invoices', [FeeInvoiceController::class,'index'])->name('fees-invoices.index');
            Route::get('/fees-invoices/{id}', [FeeInvoiceController::class,'create'])->name('fees-invoices.create');
            Route::post('/fees-invoices-store', [FeeInvoiceController::class,'store'])->name('fees-invoices.store');
            Route::get('/fees-invoices-edit/{id}', [FeeInvoiceController::class,'edit'])->name('fees-invoices.edit');
            Route::post('/fees-invoices-update', [FeeInvoiceController::class,'update'])->name('fees-invoices.update');
            Route::post('/fees-invoices-destroy', [FeeInvoiceController::class,'destroy'])->name('fees-invoices.destroy');

            Route::get('/receipt-students', [ReceiptStudentController::class,'index'])->name('receipt-students.index');
            Route::get('/receipt-students-create/{id}', [ReceiptStudentController::class,'create'])->name('receipt-students.create');
            Route::post('/receipt-students-store', [ReceiptStudentController::class,'store'])->name('receipt-students.store');
            Route::get('/receipt-students-edit/{id}', [ReceiptStudentController::class,'edit'])->name('receipt-students.edit');
            Route::post('/receipt-students-update', [ReceiptStudentController::class,'update'])->name('receipt-students.update');
            Route::post('/receipt-students-destroy', [ReceiptStudentController::class,'destroy'])->name('receipt-students.destroy');

            Route::get('/processing-fees', [ProcessingFeeController::class,'index'])->name('processing-fees.index');
            Route::get('/processing-fees-create/{id}', [ProcessingFeeController::class,'create'])->name('processing-fees.create');
            Route::post('/processing-fees-store', [ProcessingFeeController::class,'store'])->name('processing-fees.store');
            Route::get('/processing-fees-edit/{id}', [ProcessingFeeController::class,'edit'])->name('processing-fees.edit');
            Route::post('/processing-fees-update', [ProcessingFeeController::class,'update'])->name('processing-fees.update');
            Route::post('/processing-fees-destroy', [ProcessingFeeController::class,'destroy'])->name('processing-fees.destroy');




        });




        Route::view('add-parent','livewire.parent-form');

    Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    });


// Route::get('/home', 'HomeController@index')->name('home');
