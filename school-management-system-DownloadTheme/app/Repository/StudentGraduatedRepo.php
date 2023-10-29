<?php

namespace App\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Image;
use App\Gender;
use App\Grade;
use App\MyParent;
use App\Nationality;
use App\Blood;
use App\Classroom;
use App\Promotion;
use App\Section;
use App\Specialization;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentGraduatedRepo implements StudentGraduatedRepoInterface{

    public function index(){
       $students=Student::onlyTrashed()->get();
       return view('pages.students.graduated.index',['students'=>$students]);
    }

    public function create(){
        $Grades=Grade::all();
        return view('pages.students.graduated.create',['Grades'=>$Grades]);
    }

    public function softDelete($request){
        $students=Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
        if($students->count()==0){
        return redirect()->back()->with('error_Graduated', __('لاتوجد بيانات في جدول الطلاب'));

        }
        foreach($students as $student){
            $student->Delete();
        }
        toastr()->success(trans('messages.success'));
        return redirect()->back();
     
    }

    public function return($request){
        Student::onlyTrashed()->where('id',$request->id)->first()->restore();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }

    public function destroy($request){
        Student::onlyTrashed()->where('id',$request->id)->first()->forceDelete();
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }




 
}
