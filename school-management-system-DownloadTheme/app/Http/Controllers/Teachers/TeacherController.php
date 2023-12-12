<?php

namespace App\Http\Controllers\Teachers;
use App\Degree;
use App\Http\Requests\StoreTeachers;
use App\Gender;
use App\OnlineClass;
use App\Question;
use App\Teacher;
use App\Student;
use App\Section;
use App\Attendance;
use App\Quiz;
use App\Subject;
use App\Grade;
use App\Classroom;

use App\Http\Controllers\Controller;
use App\Repository\TeacherRepoInterface;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MacsiDigital\Zoom\Facades\Zoom;

class TeacherController extends Controller
{
    protected $teachers;
    public function __construct(TeacherRepoInterface $teachers){
        $this->teachers=$teachers;
    }

     public function index()
    {
        return view('pages.teachers.index',['teachers'=>$this->teachers->getAllTeachers()]) ;
    }

    public function create()
    {
        $genders=Gender::all();
        $specializations=Specialization::all();
        return view('pages.teachers.create',['specializations'=>  $specializations,'genders'=>$genders]);
    }

    public function store(StoreTeachers $r){
        return $this->teachers->store($r);
    }

    public function edit($id){
        return $this->teachers->edit($id);
    }

    public function update(StoreTeachers $request){
        return  $this->teachers->update($request);
    }

    public function delete(Request $request){
        return $this->teachers->delete($request);
    }


    ////Teacher Dashboard////

    public function getStudents(){
        //$sectionIds=Teacher::where('id',auth()->user()->id)->sections()->pluck('section_id');
        $sectionIds=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $studentsList=Student::whereIn('section_id',$sectionIds)->get();
        return view('pages.teachers.students_list',['studentsList'=>$studentsList]);
    }

    public function getTeacherSections(){
        $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $ids)->get();

        return view('pages.teachers.sections_list',['sections'=>$sections]);

    }

    //Attendance

    public function attendance(Request $request){

try{
    $date=date('Y-m-d');
    foreach($request->attendences as $studentId=>$attendance){
       if($attendance=='presence'){
        $status=true;
       }else{
        $status=false;
       }

       Attendance::updateorCreate(['student_id'=>$studentId],[
        'student_id' => $studentId,
        'grade_id' => $request->grade_id,
        'classroom_id' => $request->classroom_id,
        'section_id' => $request->section_id,
        'teacher_id' => auth()->user()->id,
        'attendence_date' => $date,
        'attendence_status' => $status

       ]);
    }
    toastr()->success(trans('messages.success'));
    return redirect()->back();

}catch(\Exception $e){
    return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
}
  }

  public function attendanceReport(){
    $sectionIds=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
    $studentsList=Student::whereIn('section_id',$sectionIds)->get();
    return view('pages.teachers.attendence_report',['studentsList'=>$studentsList]);
  }

  public function attendanceSearch(Request $request){
    $sectionIds=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
    $studentsList=Student::whereIn('section_id',$sectionIds)->get();
    $request->validate([
        'from'  =>'required|date|date_format:Y-m-d',
        'to'=> 'required|date|date_format:Y-m-d|after_or_equal:from'
    ],[
        'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
        'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
    ]);
    if($request->student_id==0){
        $result=Attendance::whereBetween('attendence_date',[$request->from,$request->to])->get();
        return view('pages.teachers.attendence_report',['studentsList'=>$studentsList,'result'=>$result]);

    }else{
        $result=Attendance::whereBetween('attendence_date',[$request->from,$request->to])->where('student_id',$request->student_id)->get();
        return view('pages.teachers.attendence_report',['studentsList'=>$studentsList,'result'=>$result]);
    }

  }


  ///Quizzes

  public function quizzes(){
$quizzes=Quiz::where('teacher_id',auth()->user()->id)->get();
return view('pages.teachers.quizzes.index',['quizzes'=>$quizzes]);
  }

  public function createQuiz(){
    $data['subjects']=Subject::where('teacher_id',auth()->user()->id)->get();
    $data['grades']=Grade::all();
    return view('pages.teachers.quizzes.create',$data);
}

public function storeQuiz(Request $request){
    try{
        Quiz::create([
            'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
            'subject_id'=>$request->subject_id,
            'grade_id'=>$request->Grade_id,
            'classroom_id'=>$request->Classroom_id,
            'section_id'=>$request->section_id,
            'teacher_id'=>auth()->user()->id
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->route('teacher-quizzes.index');

    }catch(\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

public function editQuiz($id){
    $quizz=Quiz::find($id);
    $subjects=Subject::all();
    $grades=Grade::all();
    return view('pages.teachers.quizzes.edit',['quizz'=>$quizz,'subjects'=>$subjects,'grades'=>$grades]);
}


public function updateQuiz(Request $request){
    try {
        $quizz = Quiz::findorFail($request->id);
        $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
        $quizz->subject_id = $request->subject_id;
        $quizz->grade_id = $request->Grade_id;
        $quizz->classroom_id = $request->Classroom_id;
        $quizz->section_id = $request->section_id;
        $quizz->teacher_id = auth()->user()->id;
        $quizz->save();
        toastr()->success(trans('messages.Update'));
        return redirect()->route('quizzes.index');
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }

}

public function deleteQuiz($id){
    try {
        Quiz::destroy($id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    } catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}


public function getDegrees ($quiz_id){
        $degrees=Degree::where('quiz_id',$quiz_id)->get();
        return view('pages.teachers.quizzes.show-degrees',['degrees'=>$degrees]);
}

    public function repeatQuiz (Request  $request){
       Degree::where('quiz_id',$request->quiz_id)->where('student_id',$request->student_id)->delete();
        toastr()->success('تم فتح الاختبار مرة اخرى للطالب');
        return redirect()->back();
    }





////Questions

public function questions($id){
    $questions =Question::where('quiz_id',$id)->get();
     $quizz=Quiz::findorFail($id);
     return view('pages.teachers.quizzes.questions',['questions' =>$questions ,'quizz'=>$quizz]);
}

public function createQuestion($id){

        return view('pages.teachers.quizzes.create-question',['quizz_id'=>$id]);

}

    public function storeQuestion(Request $r,$id){
        $quiz_id=$id;

        try{
            $question=new Question();
            $question->title=$r->title;
            $question->answers=$r->answers;
            $question->right_answer=$r->right_answer;
            $question->score=$r->score;
            $question->quiz_id=$quiz_id;
            $question->save();
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);

        }

    }
    public function editQuestion($id)
    {
        $question=Question::findorFail($id);
        return view('pages.teachers.quizzes.edit-question',['question'=>$question]);
    }

    public function updateQuestion(Request $r,$id){


        try{
            $question= Question::findorFail($id);
            $question->title=$r->title;
            $question->answers=$r->answers;
            $question->right_answer=$r->right_answer;
            $question->score=$r->score;

            $question->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->back();

        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);

        }
    }

    public function deleteQuestion($id){
        try {
            Question::destroy($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    ///online meetings

    public function getAllMeetings(){
        $online_classes=OnlineClass::where('created_by',auth()->user()->email)->get();
        return view('pages.teachers.online_classes.index',['online_classes'=>$online_classes]);
    }
    public function createIndirectMeeting(){
        $Grades=Grade::all();
        return view('pages.teachers.online_classes.indirect',['Grades'=>$Grades]);
    }

    public function storeIndirectMeeting(Request $request){
        try {


            OnlineClass::create([
                'Grade_id' => $request->Grade_id,
                'integration'=>0,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'created_by' => auth()->user()->email,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroyMeeting(Request $request){
        $info = OnlineClass::find($request->id);


        if( $info->integration==1){
            $meeting = Zoom::meeting()->find($request->meeting_id);
            $meeting->delete();

            OnlineClass::destroy($request->id);
        }else{
            OnlineClass::destroy($request->id);
        }
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }


    //Update Profile




    public function UpdateProfile(Request  $request,$id){
        $information = Teacher::findorFail($id);

        if (!empty($request->password)) {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.Update'));

        return view('pages.teachers.profile',['information'=>$information]);
    }





}
