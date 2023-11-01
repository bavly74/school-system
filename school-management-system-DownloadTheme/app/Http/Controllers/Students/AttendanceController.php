<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Repository\AttendanceRepoInterface;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    protected $attendance;
    public function __construct(AttendanceRepoInterface $attendance)
    {
        $this->attendance=$attendance;
        
    }
    public function index(){
        return $this->attendance->index();
    }

    public function create($id){
        return $this->attendance->create($id);
    }

    public function store(Request $request){
        return $this->attendance->store($request);

    }
  
    public function edit($id){
        return $this->attendance->edit($id);
    }

    public function update(Request $request){
        return $this->attendance->update($request);
   }

    public function destroy(Request $request){
        return $this->attendance->destroy($request);
    }

    public function show($id){
        return $this->attendance->show($id);
    }
}
