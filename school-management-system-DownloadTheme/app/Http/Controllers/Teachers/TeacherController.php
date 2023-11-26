<?php

namespace App\Http\Controllers\Teachers;
use App\Http\Requests\StoreTeachers;
use App\Gender;
use App\Teacher;
use App\Student;
use App\Section;

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

    public function getStudents(){
        //$sectionIds=Teacher::where('id',auth()->user()->id)->sections()->pluck('section_id');
        $sectionIds=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $studentsList=Student::whereIn('section_id',$sectionIds)->get();
        return view('pages.teachers.students_list',['studentsList'=>$studentsList]);
    }

    public function getSections(){
        $ids=DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $ids)->get();
       
        return view('pages.teachers.sections_list',['sections'=>$sections]);
        
    }
}
