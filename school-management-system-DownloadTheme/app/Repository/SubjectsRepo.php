<?php

namespace App\Repository;

use App\Gender;
use App\Grade;
use App\Specialization;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class SubjectsRepo implements SubjectsRepoInterface{

    public function index(){
        $subjects=Subject::all();
        return view('pages.subjects.index',['subjects'=>$subjects]);
    }

    public function create(){
        $grades=Grade::all();
        $teachers=Teacher::all();

        return view('pages.subjects.create',['grades'=>$grades,'teachers'=> $teachers]);
    }

    public function store($request){
   
        try{
            Subject::create([
                'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
                'grade_id'=>$request->Grade_id,
                'classroom_id'=>$request->Class_id,
                'teacher_id'=>$request->teacher_id,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('subjects.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
  

    public function edit($id){
        $subject=Subject::findOrFail($id);
        $teachers=Teacher::all();
        $grades=Grade::all();
        return view('pages.subjects.edit',['subject'=>$subject,'teachers'=>$teachers,'grades'=>$grades]);
    }

    public function update($request){
        try{
            Subject::where('id',$request->id)->update([
                'name'=>['en'=>$request->Name_en,'ar'=>$request->Name_ar],
                'grade_id'=>$request->Grade_id,
                'classroom_id'=>$request->Class_id,
                'teacher_id'=>$request->teacher_id,
            ]);
            toastr()->success(trans('messages.Update'));
            return redirect()->route('subjects.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

        }
    }
    public function destroy($request){
        Subject::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('subjects.index');
    }

    public function show($id){

    }
}
