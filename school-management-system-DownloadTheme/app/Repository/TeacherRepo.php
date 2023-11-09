<?php

namespace App\Repository;

use App\Gender;
use App\Specialization;
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
                'email'=>$r->Email,
                'password'=>$r->Password,
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

    public function edit($id){
        $Teachers=Teacher::where('id',$id)->first();
        $specializations=Specialization::all();
        $genders=Gender::all();
        return view('pages.teachers.edit',['Teachers'=>$Teachers,'genders'=>$genders,'specializations'=>$specializations]);
    }


    public function update($request){
        try{
            $teacher=Teacher::where('id',$request->id)->first();
            $teacher->email=$request->Email;
            $teacher->password=$request->Password;
            $teacher->Name=['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $teacher->Specialization_id=$request->Specialization_id;
            $teacher->Gender_id=$request->Gender_id;
            $teacher->Joining_Date=$request->Joining_Date;
            $teacher->Address=$request->Address;
            $teacher->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('teachers.index');
        }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

    public function delete($request){
        Teacher::where('id',$request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('teachers.index');
    }


}
