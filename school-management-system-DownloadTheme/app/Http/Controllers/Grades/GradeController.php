<?php

namespace App\Http\Controllers\Grades;

use App\Grade;
use  App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index(){
        $data=Grade::all();
        return view('pages.grades.index',['data'=>$data]);
    }

    public function store(StoreGrades $request){
        if(Grade::where('name->ar',$request->Name)->orWhere('name->en',$request->Name_en)->exists()){
            toastr()->error(trans('messages.Exists'));
            return redirect()->route('grades.index');
        }
        try{
            $validated = $request->validated();

            $grade=new Grade();
            $grade->name=['en' => $request->Name_en, 'ar' => $request->Name];
            $grade->notes=$request->Notes;
            $grade->save();
    
            toastr()->success(trans('messages.success'));
            return redirect()->route('grades.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
     
    }

    public function update(StoreGrades $request){
        if(Grade::where('name->ar',$request->Name)->orWhere('name->en',$request->Name_en)->exists()){
            toastr()->error(trans('messages.Exists'));
            return redirect()->route('grades.index');
        }
        try{
            $validated = $request->validated();

            $grade= Grade::where('id',$request->id)->first();
            $grade->update([
                $grade->name=['en' => $request->Name_en, 'ar' => $request->Name],
                $grade->notes=$request->Notes
            ]);
        
           
    
            toastr()->success(trans('messages.Update'));
            return redirect()->route('grades.index');
        }
        catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request){
        Grade::where('id',$request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('grades.index');
    }
}
