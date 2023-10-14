<?php

namespace App\Http\Controllers\Classroom;

use App\Classroom;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ClassroomController extends Controller
{
   public function index(){
    $data=Classroom::all();
    return view('pages.classrooms.index',['data'=>$data]);
   }
}
