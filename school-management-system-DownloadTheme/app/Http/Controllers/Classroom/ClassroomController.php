<?php

namespace App\Http\Controllers\Classroom;

use App\Classroom;
use App\Grade;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
   public function index(){
   $grades=Grade::all();
    $data=Classroom::all();
    return view('pages.classrooms.index',['data'=>$data,'grades'=>$grades]);
   }

   public function store(StoreClassroom $request){
   //    $request->validate([
   //       'List_Classes.*.Name_class_en'=>'required',
   //       'List_Classes.*.Name'=>'required'

   //    ],
   //    [
   //       'Name_class_en.required'=>trans('validation.required'),
   //       'Name.required'=>trans('validation.required'),  
   //    ]
   
   // );
   
      $list_classes=$request->List_Classes;
      try{
         $validated = $request->validated();
         foreach($list_classes as $list){
            
            $class=new Classroom();
            $class->name=['en'=>$list['Name_class_en'],'ar'=>$list['Name']];
            $class->grade_id=$list['Grade_id'];
            $class->save();
         }
         toastr()->success(trans('messages.success'));
         return redirect()->route('classrooms.index');    
         }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

         }

      }

      public function update(Request $request){
         $request->validate([
            'Name'=>'required',
            'Name_en'=>'required'
         ]);

         try{
            $classroom=Classroom::where('id',$request->id)->update([
               'name'=>['en'=>$request->Name_en,'ar'=>$request->Name],
               'grade_id'=>$request->grade_id
              ]);
              toastr()->success(trans('messages.Update'));
              return redirect()->route('classrooms.index');    
         }catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);

         }
       
      }

      public function delete(Request $request){
       $classroom=  Classroom::where('id',$request->id)->delete();
         toastr()->error(trans('messages.Delete'));
         return redirect()->route('classrooms.index');    
      }
   }

