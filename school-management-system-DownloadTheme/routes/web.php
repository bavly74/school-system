<?php
use App\Attendance;
use App\Http\Controllers\Classroom\ClassroomController;
use App\Http\Controllers\Exams\ExamController;
use App\Http\Controllers\Students\AttendanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Quizes\QuizController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\PaymentStudentController;
use App\Http\Controllers\Students\FeeInvoiceController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\GraduatesController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\Students\OnlineClassController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\ReceiptStudentController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\SettingController;
use App\OnlineClass;
use App\ProcessingFee;
use App\Question;
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
// Auth::routes();
Route::get('/', 'HomeController@index')->name('selection');

Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}',[LoginController::class,'loginForm'])->middleware('guest')->name('login.show');
    
    Route::post('/login','LoginController@login')->name('login');
    Route::get('/logout/{type}', 'LoginController@logout')->name('logout');
});
 

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){

       Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

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

            Route::get('/payment', [PaymentStudentController::class,'index'])->name('payment.index');
            Route::get('/payment-create/{id}', [PaymentStudentController::class,'create'])->name('payment.create');
            Route::post('/payment-store', [PaymentStudentController::class,'store'])->name('payment.store');
            Route::get('/payment-edit/{id}', [PaymentStudentController::class,'edit'])->name('payment.edit');
            Route::post('/payment-update', [PaymentStudentController::class,'update'])->name('payment.update');
            Route::post('/payment-destroy', [PaymentStudentController::class,'destroy'])->name('payment.destroy');

            Route::get('/attendance', [AttendanceController::class,'index'])->name('attendance.index');
            Route::get('/attendance-create/{id}', [AttendanceController::class,'create'])->name('attendance.create');
            Route::post('/attendance-store', [AttendanceController::class,'store'])->name('attendance.store');

            Route::get('/online-class', [OnlineClassController::class,'index'])->name('online-class.index');
            Route::get('/online-class-create', [OnlineClassController::class,'create'])->name('online-class.create');
            Route::post('/online-class-store', [OnlineClassController::class,'store'])->name('online-class.store');
            
            Route::get('/indirect-meeting', [OnlineClassController::class,'createIndirectMeeting'])->name('indirect-meeting.create');
            Route::post('/indirect-meeting', [OnlineClassController::class,'storeIndirectMeeting'])->name('indirect-meeting.store');
            Route::post('/online-class-destroy', [OnlineClassController::class,'destroy'])->name('online-class.destroy');

            Route::get('/library', [LibraryController::class,'index'])->name('library.index');
            Route::get('/library-create', [LibraryController::class,'create'])->name('library.create');
            Route::post('/library-store', [LibraryController::class,'store'])->name('library.store');
            Route::get('/library-downloadAttachment/{filename}', [LibraryController::class,'downloadAttachment'])->name('library.downloadAttachment');
            Route::get('/library-edit/{id}', [LibraryController::class,'edit'])->name('library.edit');
            Route::post('/library-update', [LibraryController::class,'update'])->name('library.update');
            Route::post('/library-delete', [LibraryController::class,'destroy'])->name('library.delete');

        });

        Route::group(['namespace'=>'Subjects'],function(){
            Route::get('/subjects', [SubjectController::class,'index'])->name('subjects.index');
            Route::get('/subjects-create', [SubjectController::class,'create'])->name('subjects.create');
            Route::post('/subjects-store', [SubjectController::class,'store'])->name('subjects.store');
            Route::get('/subjects-edit/{id}', [SubjectController::class,'edit'])->name('subjects.edit');
            Route::post('/subjects-update', [SubjectController::class,'update'])->name('subjects.update');
            Route::post('/subjects-destroy', [SubjectController::class,'destroy'])->name('subjects.destroy');
            Route::get('/subjects-show/{id}', [SubjectController::class,'show'])->name('subjects.show');
        });

        Route::group(['namespace'=>'Exams'],function(){
            Route::get('/exams', [ExamController::class,'index'])->name('exams.index');
            Route::get('/exams-create', [ExamController::class,'create'])->name('exams.create');
            Route::post('/exams-store', [ExamController::class,'store'])->name('exams.store');
            Route::get('/exams-edit/{id}', [ExamController::class,'edit'])->name('exams.edit');
            Route::post('/exams-update', [ExamController::class,'update'])->name('exams.update');
            Route::post('/exams-destroy', [ExamController::class,'destroy'])->name('exams.destroy');
            Route::get('/exams-show/{id}', [ExamController::class,'show'])->name('exams.show');
        });


        Route::group(['namespace'=>'Quizes'],function(){
            Route::get('/quizzes', [QuizController::class,'index'])->name('quizzes.index');
            Route::get('/quizzes-create', [QuizController::class,'create'])->name('quizzes.create');
            Route::post('/quizzes-store', [QuizController::class,'store'])->name('quizzes.store');
            Route::get('/quizzes-edit/{id}', [QuizController::class,'edit'])->name('quizzes.edit');
            Route::post('/quizzes-update', [QuizController::class,'update'])->name('quizzes.update');
            Route::post('/quizzes-destroy', [QuizController::class,'destroy'])->name('quizzes.destroy');
            Route::get('/quizzes-show/{id}', [QuizController::class,'show'])->name('quizzes.show');
        });

        Route::group(['namespace'=>'Questions'],function(){
            Route::get('/questions', [QuestionController::class,'index'])->name('questions.index');
            Route::get('/questions-create', [QuestionController::class,'create'])->name('questions.create');
            Route::post('/questions-store', [QuestionController::class,'store'])->name('questions.store');
            Route::get('/questions-edit/{id}', [QuestionController::class,'edit'])->name('questions.edit');
            Route::post('/questions-update', [QuestionController::class,'update'])->name('questions.update');
            Route::post('/questions-destroy', [QuestionController::class,'destroy'])->name('questions.destroy');
            Route::get('/questions-show/{id}', [QuestionController::class,'show'])->name('questions.show');
        });

        Route::group(['namespace'=>'Setting'],function(){
            Route::get('/settings', [SettingController::class,'index'])->name('settings.index');
            Route::post('/settings-update', [SettingController::class,'update'])->name('settings.update');


        });

        Route::view('add-parent','livewire.parent-form');

    // Route::get('/dashboard', 'HomeController@index')->name('dashboard');
    Route::get('/selection', function(){return view('auth.selection');});

    });


// Route::get('/home', 'HomeController@index')->name('home');
