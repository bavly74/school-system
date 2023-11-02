<?php

namespace App\Repository;

use App\Attendance;
use App\Grade;
use App\OnlineClass;
use App\Student;
use App\Teacher;
use App\Http\Traits\ZoomTrait;

class ZoomMeetingRepo implements ZoomMeetingRepoInterface{
    use ZoomTrait;

    public function index(){
        $online_classes=OnlineClass::all();
        return view('pages.online_classes.index',['online_classes'=>$online_classes]);
    }

    public function create(){
        $Grades=Grade::all();
        return view('pages.online_classes.create',['Grades'=>$Grades]);
    }
    public function store($request){
        try {

            $meeting = $this->createMeeting($request);
            OnlineClass::create([
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
 
    public function delete($request){

    }


}
