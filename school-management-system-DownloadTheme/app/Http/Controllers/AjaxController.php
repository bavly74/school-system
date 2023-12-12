<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Section;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getClassrooms($id)
    {
        $list_classes = Classroom::where("grade_id", $id)->pluck("name", "id");
        return $list_classes;
    }

//Get Sections
    public function Get_Sections($id){
        $list_sections = Section::where("classroom_id", $id)->pluck("name", "id");
        return $list_sections;
    }
}
