<?php

namespace App\Repository;

use App\Gender;
use App\Grade;
use App\MyParent;
use App\Nationality;
use App\Blood;

use App\Specialization;
use App\Teacher;
use Illuminate\Http\Request;

class StudentRepo implements StudentRepoInterface{

    public function create(){
        $data['my_classes'] = Grade::all();
        $data['parents'] = MyParent::all();
        $data['Genders'] = Gender::all();
        $data['nationals'] = Nationality::all();
        $data['bloods'] = Blood::all();
        return view('pages.students.create',$data);

    }


}
