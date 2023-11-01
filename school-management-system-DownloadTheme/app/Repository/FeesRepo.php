<?php

namespace App\Repository;
use App\Grade;
use App\Fees;

class FeesRepo implements FeesRepoInterface{
    public function index(){
        $fees=Fees::all();
        return view('pages.fees.index',['fees'=>$fees]);
    }
    public function create(){
        $Grades=Grade::all();
        return view('pages.fees.create',['Grades'=>$Grades]);

    }
    public function store($request){
        try{

        Fees::create([
            'title'=>['en'=>$request->title_en,'ar'=>$request->title_ar],
            'amount'=>$request->amount,
            'Grade_id'=>$request->Grade_id,
            'Classroom_id'=>$request->Classroom_id,
            'description'=>$request->description,
            'year'=>$request->year,
            'Fee_type'=>$request->Fee_type

        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    }catch(\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);

    }

    }
    public function show($id){

    }
    
    public function edit($id){
        $Grades=Grade::all();
        $fee=Fees::findOrFail($id);
        return view('pages.fees.edit',['Grades'=>$Grades,'fee'=>$fee]);
    }

    public function update($request){
        $fee=Fees::findOrFail($request->id);
        try{
        $fee->update([
            'title'=>['en'=>$request->title_en,'ar'=>$request->title_ar],
            'amount'=>$request->amount,
            'Grade_id'=>$request->Grade_id,
            'Classroom_id'=>$request->Classroom_id,
            'description'=>$request->description,
            'year'=>$request->year,
            'Fee_type'=>$request->Fee_type
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->back();
       }catch(\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }
   }

    public function destroy($request){
        Fees::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }



}
