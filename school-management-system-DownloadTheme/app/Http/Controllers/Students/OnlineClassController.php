<?php

namespace App\Http\Controllers\Students;
use  App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\ZoomMeetingRepoInterface;
class OnlineClassController extends Controller
{
    protected $meeting;
    public function __construct(ZoomMeetingRepoInterface $meeting){
        $this->meeting=$meeting;
    }
    public function index(){
       return $this->meeting->index();
    }
    public function create(){
        return $this->meeting->create();
    }
    public function store(Request $request){
        return $this->meeting->store($request);

    }
    
    public function destroy(Request $request){
        return $this->meeting->destroy($request);
    }

    public function createIndirectMeeting(){
        return $this->meeting->createIndirectMeeting();
    }
    public function storeIndirectMeeting(Request $request){
        return $this->meeting->storeIndirectMeeting($request);

    }



}
