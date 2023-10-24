<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Repository\StudentRepoInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $students;
    public function __construct(StudentRepoInterface $students)
    {
        $this->students=$students;

    }
    public function index(){
        return view('pages.students.index',['students'=>$this->students->getStudents()]);
    }

   public function create(){
    return $this->students->create();
   }

   public function store(Request $request){
    return  $this->students->store($request);
   }

   public function edit($id){
    return $this->students->edit($id);
}

public function update(Request $request){
   return $this->students->update($request);
}

public function delete(Request $request){
    return $this->students->delete($request);
 }

   public function getClassrooms($id){
    return $this->students->getClassrooms($id);
   }

   public function getSections($id){
    return $this->students->getSections($id);
   }
   
}
