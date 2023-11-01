<?php

namespace App\Repository;

use App\Attendance;
use App\Grade;
use App\Quiz;
use App\Student;
use App\Subject;
use App\Teacher;


class QuizesRepo implements QuizesRepoInterface{

    public function index(){
       $quizzes=Quiz::all();
       return view('pages.quizes.index',['quizzes'=>  $quizzes]);
    }
   

    public function create(){
        $data['subjects']=Subject::all();
        $data['teachers']=Teacher::all();
        $data['grades']=Grade::all();
       return view('pages.quizes.create',$data);
    }

    public function store($request){
        try{
            Quiz::create([
                'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
                'subject_id'=>$request->subject_id,
                'grade_id'=>$request->Grade_id,
                'classroom_id'=>$request->Classroom_id,
                'section_id'=>$request->section_id,
                'teacher_id'=>$request->teacher_id
            ]); 
            toastr()->success(trans('messages.success'));
            return redirect()->route('quizzes.index');

        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
       
    }

    public function edit($id){
       $quizz=Quiz::findOrFail($id);
       $data['subjects']=Subject::all();
        $data['teachers']=Teacher::all();
        $data['grades']=Grade::all();
       return view('pages.quizes.edit',$data,compact('quizz'));
    }

    public function update($request){
        
}
public function destroy($request){
    
}



}
