<?php

namespace App\Http\Controllers\Sections;

use App\Classroom;
use App\Grade;
use App\Http\Controllers\Controller;
use App\Section;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class SectionController extends Controller
{
    public function index (){
        $section_grade=Grade::with('sections')->get();
        $grades=Grade::all();
        return view ('pages.sections.index',['section_grade'=> $section_grade,'grades'=>$grades]);
    }

    public function store(Request $request){
        $request->validate([
            'Name_Section_Ar'=>'required',
            'Name_Section_En'=>'required'
        ]);
        try{
            Section::create([
                'name'=>['en'=>$request->Name_Section_Ar,'ar'=>$request->Name_Section_En],
                'grade_id'=>$request->Grade_id,
                'classroom_id'=>$request->Class_id,
            ]);
            
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
            Section::where('id',$request->id)->update([
                'name'=>['en'=>$request->Name_Section_Ar,'ar'=>$request->Name_Section_En],
                'grade_id'=>$request->Grade_id,
                'classroom_id'=>$request->Class_id,
            ]);
            
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
