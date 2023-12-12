<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Quiz;
use App\Repository\StudentRepoInterface;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    protected $students;
    public function __construct(StudentRepoInterface $students)
    {
        $this->students = $students;
    }
    public function index()
    {
        return view('pages.students.index', ['students' => $this->students->getStudents()]);
    }

    public function create()
    {
        return $this->students->create();
    }

    public function store(Request $request)
    {
        return  $this->students->store($request);
    }

    public function edit($id)
    {
        return $this->students->edit($id);
    }

    public function show($id)
    {
        return $this->students->show($id);
    }

    public function upload_attachment(Request $request)
    {
        return $this->students->upload_attachment($request);
    }

    public function Download_attachment($studentName, $fileName)
    {
        return $this->students->Download_attachment($studentName, $fileName);
    }

    public function deleteAttachment(Request $request)
    {
        return $this->students->deleteAttachment($request);
    }

    public function update(Request $request)
    {
        return $this->students->update($request);
    }

    public function delete(Request $request)
    {
        return $this->students->delete($request);
    }

    public function graduate($id)
    {
        return $this->students->graduate($id);
    }

    public function getClassrooms($id)
    {
        return $this->students->getClassrooms($id);
    }

    public function getSections($id)
    {
        return $this->students->getSections($id);
    }

    /// Student Dashboard

    //Quiz
    public function getAllQuizzes(){
        $quizzes=Quiz::where('grade_id', auth()->user()->Grade_id)
            ->where('classroom_id', auth()->user()->Classroom_id)
            ->where('section_id', auth()->user()->section_id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('pages.students.quizzes.index',['quizzes'=>$quizzes]);
    }

    public function showQuiz($quiz_id){
        $student_id=auth()->user()->id;
        return view('pages.students.quizzes.show',['student_id'=>$student_id,'quiz_id'=>$quiz_id]);
    }

    //profile


    public function showProfile(){
        $information=Student::findorFail(auth()->user()->id);
        return view('pages.students.student-profile',['information'=>$information]);
    }

    public function updateProfile(Request $request,$id){
        $information = Student::findorFail($id);

        if (!empty($request->password)) {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }

}
