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

class StudentPromotionRepo implements StudentPromotionRepoInterface{

    public function index(){
        $data['Grades']=Grade::all();
        $data['Classrooms']=Classroom::all();

        return view('pages.students.promotions.index',$data);
    }

    
    public function store($request){
      //      DB::beginTransaction();
        try{
        $students= Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->get();
        if($students->count()<1){
            toastr()->error(trans('messages.Update'));
            return redirect()->back();
        }

        foreach($students as $student){

            $ids = explode(',',$student->id);
            
            student::whereIn('id', $ids)
                ->update([
                    'Grade_id'=>$request->Grade_id_new,
                    'Classroom_id'=>$request->Classroom_id_new,
                    'section_id'=>$request->section_id_new,
                ]);

            Promotion::updateOrCreate([
                     'student_id'=>$student->id,

                     'from_grade'=>$request->Grade_id,
                     'from_Classroom'=>$request->Classroom_id,
                     'from_section'=>$request->section_id,

                     'to_grade'=>$request->Grade_id_new,
                     'to_Classroom'=>$request->Classroom_id_new,
                     'to_section'=>$request->section_id_new
            ]);

           DB::commit();

            toastr()->success(trans('messages.Update'));
            return redirect()->back();
        }
       
    }catch(\Exception $e){
       DB::rollBack();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);

    }

    }
}
