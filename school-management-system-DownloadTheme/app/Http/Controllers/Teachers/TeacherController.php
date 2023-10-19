<?php

namespace App\Http\Controllers\Teachers;

use App\Gender;
use App\Http\Controllers\Controller;
use App\Repository\TeacherRepoInterface;
use App\Specialization;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    protected $teachers;
    public function __construct(TeacherRepoInterface $teachers){
        $this->teachers=$teachers;
    }

     public function index()
    {
        return view('pages.teachers.index',['teachers'=>$this->teachers->getAllTeachers()]) ;
    }

    public function create()
    {
        $genders=Gender::all();
        $specializations=Specialization::all();
        return view('pages.teachers.create',['specializations'=>  $specializations,'genders'=>$genders]);
    }

    public function store(Request $r){
        return $this->teachers->store($r);
    }
}
