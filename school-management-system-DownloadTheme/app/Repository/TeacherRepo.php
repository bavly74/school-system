<?php

namespace App\Repository;

use App\Teacher;
use Illuminate\Http\Request;

class TeacherRepo implements TeacherRepoInterface{

    public function getAllTeachers()
    {
        return Teacher::all();
    }

    public function store(Request $r){
        $r->validate([
            'Email'=>'required',
                'Password'=>'required',
                'Name_ar'=>'required',
                'Name_en'=>'required',
                'Specialization_id'=>'required',
                'Gender_id'=>'required',
                'Joining_Date'=>'required',
                'Address'=>'required',

        ]);

        try{
            Teacher::create([
                'Email'=>$r->Email,
                'Password'=>$r->Password,
                'Name'=>['ar'=>$r->Name_ar,'en'=>$r->Name_en],
                'Specialization_id'=>$r->Specialization_id,
                'Gender_id'=>$r->Gender_id,
                'Joining_Date'=>$r->Joining_Date,
                'Address'=>$r->Address,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('teachers.create');
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);

        }
    


    }
}