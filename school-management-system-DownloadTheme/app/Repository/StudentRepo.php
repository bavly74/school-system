<?php

namespace App\Repository;
use Illuminate\Support\Facades\Hash;

use App\Gender;
use App\Grade;
use App\MyParent;
use App\Nationality;
use App\Blood;
use App\Classroom;
use App\Section;
use App\Specialization;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;

class StudentRepo implements StudentRepoInterface{

    public function getStudents(){
        return Student::all();
    }

    public function create(){
        $data['my_classes'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        return view('pages.students.create',$data);

    }

    public function store($request){
        try {
            $students = new Student();
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationality_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
            //dd($students->getAttributes());
            $students->save();
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.create');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
      
    }

    public function edit($id){
        $data['Grades'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        $Students =  Student::findOrFail($id);
        return view('pages.students.edit',$data,compact('Students'));
    }

    public function update($request){
        try {
            $students =  Student::findOrFail($request->id);
            $students->name = ['en' => $request->name_en, 'ar' => $request->name_ar];
            $students->email = $request->email;
            $students->password = Hash::make($request->password);
            $students->gender_id = $request->gender_id;
            $students->nationality_id = $request->nationalitie_id;
            $students->blood_id = $request->blood_id;
            $students->Date_Birth = $request->Date_Birth;
            $students->Grade_id = $request->Grade_id;
            $students->Classroom_id = $request->Classroom_id;
            $students->section_id = $request->section_id;
            $students->parent_id = $request->parent_id;
            $students->academic_year = $request->academic_year;
           
            $students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('students.index');
        }

        catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function delete($request){
        Student::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('students.index');
    }


    public function getClassrooms($id){
        return Classroom::where('grade_id',$id)->pluck("name", "id");
    }

    public function getSections($id){
        return Section::where('classroom_id',$id)->pluck("name", "id");
    }



}
