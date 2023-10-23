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
   public function create(){
    return $this->students->create();
   }
}
