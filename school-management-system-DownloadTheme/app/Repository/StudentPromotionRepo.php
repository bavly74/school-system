<?php

namespace App\Repository;
use App\Grade;
use App\Classroom;
use App\Promotion;
use App\Student;

class StudentPromotionRepo implements StudentPromotionRepoInterface{

    public function index(){
        $data['Grades']=Grade::all();
        $data['Classrooms']=Classroom::all();

        return view('pages.students.promotions.index',$data);
    }


    public function store($request){

      //  DB::beginTransaction();

        try {

            $students = student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();

            if($students->count() < 1){
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            // update in table student
            foreach ($students as $student){

                $ids = explode(',',$student->id);

                Student::whereIn('id', $ids)
                    ->update([
                        'Grade_id'=>$request->Grade_id_new,
                        'Classroom_id'=>$request->Classroom_id_new,
                        'section_id'=>$request->section_id_new,
                        'academic_year'=>$request->academic_year_new,
                    ]);

                // insert in to promotions
                Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_Classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_Classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'from_year'=>$request->academic_year,
                    'to_year'=>$request->academic_year_new,
                ]);

            }

            //DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->back();

        } catch (\Exception $e) {
         //   DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }


    public function create(){
        $promotions=Promotion::all();
        return view('pages.students.promotions.management',['promotions'=>$promotions]);
    }

    public function destroy($request){
        if($request->x==1){
            $promotions=Promotion::all();
            foreach($promotions as $promotion){
                student::where('id', $promotion->student_id)
                ->update([
                'Grade_id'=>$promotion->from_grade,
                'Classroom_id'=>$promotion->from_Classroom,
                'section_id'=> $promotion->from_section,
                'academic_year'=>$promotion->from_year,
                ]);

            }
            Promotion::truncate();
            toastr()->success(trans('messages.success'));

            return redirect()->back();
        }else{
            $promotion=Promotion::findOrFail($request->id);
            Student::where('id',$promotion->student_id)->update([
                'Grade_id'=>$promotion->from_grade,
                'Classroom_id'=>$promotion->from_Classroom,
                'section_id'=> $promotion->from_section,
                'academic_year'=>$promotion->from_year,
            ]);
            $promotion->destroy($request->id);
            toastr()->error(trans('messages.Delete'));

            return redirect()->back();
        }

    }
}
