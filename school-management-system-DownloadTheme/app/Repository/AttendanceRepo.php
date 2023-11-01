<?php

namespace App\Repository;

use App\Attendance;
use App\Grade;
use App\Student;
use App\Teacher;


class AttendanceRepo implements AttendanceRepoInterface{

    public function index(){
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $teachers = Teacher::all();
        return view('pages.attendance.sections',compact('Grades','list_Grades','teachers'));
    }
   

    public function create($id){
        $students = Student::with('attendance')->where('section_id',$id)->get();    
        return view('pages.attendance.index',compact('students'));
    }

    public function store($request){
      try{
        
        foreach($request->attendences as $studentid=>$attendence){

            if( $attendence == 'presence' ) {
                $attendence_status = true;
            } else {
                $attendence_status = false;
            }

            Attendance::create([
                'student_id'=> $studentid,
                'grade_id'=> $request->grade_id,
                'classroom_id'=> $request->classroom_id,
                'section_id'=> $request->section_id,
                'teacher_id'=> 1,
                'attendence_date'=> date('Y-m-d'),
                'attendence_status'=> $attendence_status
            ]);
            
        }
        toastr()->success(trans('messages.success'));
            return redirect()->back();

      }catch(\Exception $e){
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
      }
        
    }

    public function show($id){
       
    }

    public function edit($id){
       
    }

    public function update($request){
        
}
public function destroy($request){
    
}



}
