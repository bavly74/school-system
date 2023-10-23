<?php

namespace App\Http\Controllers\Sections;

use App\Classroom;
use App\Grade;
use App\Teacher;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class SectionController extends Controller
{
    public function index (){
        $section_grade=Grade::with('sections')->get();
        $grades=Grade::all();
        $teachers=Teacher::all();
        return view ('pages.sections.index',['section_grade'=> $section_grade,'grades'=>$grades,'teachers'=>$teachers]);
    }

    public function store(Request $request){
        $request->validate([
            'Name_Section_Ar'=>'required',
            'Name_Section_En'=>'required'
        ]);
        try{
            $Sections = new Section();
      $Sections->name = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->grade_id = $request->Grade_id;
      $Sections->classroom_id = $request->Class_id;
      $Sections->save();
      $Sections->teachers()->attach($request->teacher_id);


            toastr()->success(trans('messages.success'));
            return redirect()->route('sections.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request){
        $request->validate([
            'Name_Section_Ar'=>'required',
            'Name_Section_En'=>'required'
        ]);
        try{
            $Sections = Section::findOrFail($request->id);

      $Sections->name = ['ar' => $request->Name_Section_Ar, 'en' => $request->Name_Section_En];
      $Sections->grade_id = $request->Grade_id;
      $Sections->classroom_id = $request->Class_id;

      if (isset($request->teacher_id)) {
        $Sections->teachers()->sync($request->teacher_id);
    } else {
        $Sections->teachers()->sync(array());
    }
    
    $Sections->save();

            toastr()->success(trans('messages.success'));
            return redirect()->route('sections.index');
        }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function delete(Request $request){
        Section::where('id',$request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('sections.index');

    }

    public function getClasses($id){

        return Classroom::where('grade_id',$id)->pluck("name", "id");
    }
}
