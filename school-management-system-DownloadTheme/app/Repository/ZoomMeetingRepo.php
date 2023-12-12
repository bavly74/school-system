<?php

namespace App\Repository;
use MacsiDigital\Zoom\Facades\Zoom;

use App\Attendance;
use App\Grade;
use App\OnlineClass;
use App\Student;
use App\Teacher;
use App\Http\Traits\ZoomTrait;

class ZoomMeetingRepo implements ZoomMeetingRepoInterface{
    use ZoomTrait;

    public function index(){
        $online_classes=OnlineClass::where('created_by',auth()->user()->email)->get();
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
                'created_by' => auth()->user()->email,
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

   public function createIndirectMeeting(){
    $Grades=Grade::all();
    return view('pages.online_classes.indirect',['Grades'=>$Grades]);
   }

   public function storeIndirectMeeting($request){
    try {


        OnlineClass::create([
            'Grade_id' => $request->Grade_id,
            'integration'=>0,
            'Classroom_id' => $request->Classroom_id,
            'section_id' => $request->section_id,
            'created_by' => auth()->user()->email,
            'meeting_id' => $request->meeting_id,
            'topic' => $request->topic,
            'start_at' => $request->start_time,
            'duration' => $request->duration,
            'password' => $request->password,
            'start_url' => $request->start_url,
            'join_url' => $request->join_url,
        ]);
        toastr()->success(trans('messages.success'));
        return redirect()->back();
    } catch (\Exception $e) {
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
   }


    public function destroy($request){
        $info = OnlineClass::find($request->id);


        if( $info->integration==1){
            $meeting = Zoom::meeting()->find($request->meeting_id);
            $meeting->delete();

           OnlineClass::destroy($request->id);
        }else{
            OnlineClass::destroy($request->id);
        }
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }


}
