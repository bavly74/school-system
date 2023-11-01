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
use App\Section;
use App\Student;
use Illuminate\Support\Facades\Storage;

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
        DB::beginTransaction();
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
            if(!empty($request->photos)){
                foreach($request->file('photos') as $file){
                    $name=$file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$students->name, $name,'upload_attachments');
                    $images= new Image();
                    $images->filename=$name;
                    $images->imageable_id= $students->id;
                    $images->imageable_type = 'App\Student';
                    $images->save();
                }
            }
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('students.create');
        }
        catch (\Exception $e){
            DB::rollback();
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


    public function show($id){
        $Student=Student::findOrFail($id);
        return view('pages.students.show',['Student'=>$Student]);
    }

    public function upload_attachment($request){

        if($request->hasFile('photos')){
            foreach($request->photos as $file){
                $file->storeAs('attachments/students/'.$request->student_name,$file->getClientOriginalName(),'upload_attachments');
                Image::where('imageable_id',$request->student_id)->create([
                    'filename'=>$file->getClientOriginalName(),
                    'imageable_id'=>$request->student_id,
                    'imageable_type'=>'App\Student'
                ]);
            }
            toastr()->success(trans('messages.success'));
            return redirect()->back();
        }
    }


    public function Download_attachment($studentName,$fileName){
        return response()->download(public_path('attachments/students/'.$studentName.'/'.$fileName));
    }

    public function deleteAttachment($request){
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);
        Image::where('filename',$request->filename)->where('id',$request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();

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

    public function graduate($id){
        $student=Student::where('id',$id)->first();
        $student->Delete();
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
