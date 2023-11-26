<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Requests\StoreTeachers;
use App\Gender;
use App\Teacher;
use App\Student;
use App\Section;
use App\Attendance;
use App\Quiz;
use App\Subject;
use App\Grade;

use App\Http\Controllers\Controller;
use App\Repository\TeacherRepoInterface;
use App\Specialization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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


    //////
    
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

public function editQuiz(){

}


public function updateQuiz(Request $request){

}

public function deleteQuiz($id){

}
public function getClassrooms($id)
{
    return Classroom::where('grade_id',$id)->pluck("name", "id");
}

//Get Sections
public function Get_Sections($id){

    return Section::where('classroom_id',$id)->pluck("name", "id");
}

}
