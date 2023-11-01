<?php

namespace App\Repository;

use App\Attendance;
use App\Exam;
use App\Grade;
use App\Student;
use App\Teacher;


class ExamsRepo implements ExamsRepoInterface{


    public function index(){
        $exams=Exam::all();
        return view('pages.exams.index',['exams'=>$exams]);
    }

   

    public function create(){
       return view('pages.exams.create');
    }

    public function store($request){
      try{
        Exam::create([
            'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
            'term'=>$request->term,
            'academic_year'=>$request->academic_year
        ]);

        toastr()->success(trans('messages.success'));
        return redirect()->route('exams.index');
      }catch(\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
    }

   

    public function edit($id){
       $exam=Exam::findOrFail($id);
       return view('pages.exams.edit',['exam'=>$exam]);
    }

    public function update($request){
        try{
            Exam::where('id',$request->id)->update([
                'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
                'term'=>$request->term,
                'academic_year'=>$request->academic_year
            ]);
    
            toastr()->success(trans('messages.Update'));
            return redirect()->route('exams.index');
          }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
          }
  }

public function destroy($request){
    Exam::destroy($request->id);
    toastr()->error(trans('messages.Delete'));
    return redirect()->route('exams.index');
}

public function show($id){
       
}

}
