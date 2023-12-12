<?php
use App\Attendance;
use App\Http\Controllers\AjaxController;
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
Route::get('/Get_classrooms/{id}', [AjaxController::class,'getClassrooms']);
Route::get('/Get_Sections/{id}', [AjaxController::class,'Get_Sections']);

