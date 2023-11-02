<?php

namespace App\Repository;

use App\Attendance;
use App\Grade;
use App\Question;
use App\Quiz;
use App\Student;
use App\Teacher;


class QuestionRepo implements QuestionRepoInterface{

    public function index(){
        $questions=Question::all();
        return view('pages.questions.index',['questions'=>$questions]);
    }
   

    public function create(){
        $quizzes =Quiz::all();
            return view('pages.questions.create',['quizzes'=>$quizzes]);
    }

    public function store($request){
      try{

        Question::create([
            'title'=>$request->title,
            'answers'=>$request->answers,
            'right_answer'=>$request->right_answer,
            'score'=>$request->score,
            'quiz_id'=>$request->quiz_id,
        ]);

        toastr()->success(trans('messages.success'));
            return redirect()->back();

      }catch(\Exception $e){
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
      }
    }



    public function edit($id){
       $question=Question::findOrFail($id);
       $quizzes=Quiz::all();
       return view('pages.questions.edit',compact('question','quizzes'));
    }

    public function update($request){
        try{

            Question::where('id',$request->id)->update([
                'title'=>$request->title,
                'answers'=>$request->answers,
                'right_answer'=>$request->right_answer,
                'score'=>$request->score,
                'quiz_id'=>$request->quiz_id,
            ]);
    
            toastr()->success(trans('messages.Update'));
                return redirect()->back();
    
          }catch(\Exception $e){
            return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
          }
}

public function destroy($request){
    Question::destroy($request->id);
    toastr()->error(trans('messages.Delete'));
    return redirect()->back();
}

public function show($id){
       
}


}
