<?php

namespace App\Repository;
use App\Library;
use App\Attendance;
use App\Grade;
use App\Student;
use App\Teacher;
use Illuminate\Support\Facades\Storage;


class LibraryRepo implements LibraryRepoInterface{

    public function index(){
        $books=Library::all();
      return view('pages.myLibrary.index',['books'=>$books]);
    }
   
    public function create(){
        $grades=Grade::all();
        return view('pages.myLibrary.create',['grades'=>$grades]);
    }

    public function store($request){
     try{
        $book=new Library();
        $book->title=$request->title;
        $book->file_name=$request->file_name->getClientOriginalName();
        $book->Grade_id=$request->Grade_id;
        $book->Classroom_id=$request->Classroom_id;
        $book->section_id=$request->section_id;
        $book->teacher_id=1;
        $book->save();
if($request->hasFile('file_name')){
    $request->file('file_name')->storeAs('attachments/library/',$request->file_name->getClientOriginalName(),'upload_attachments');

}
      
        toastr()->success(trans('messages.success'));
        return redirect()->route('library.index');
     }catch(\Exception $e){
        return redirect()->back()->with(['error' => $e->getMessage()]);
    }
       
    }

    public function show($id){
       
    }

    public function edit($id){
        $book=Library::findOrFail($id);
        $grades=Grade::all();
        return view('pages.myLibrary.edit',['book'=>$book,'grades'=>$grades]);
    }

    public function update($request){
        try{
            $book= Library::findOrFail($request->id);
            $book->title=$request->title;
            
            if($request->file('file_name')){
              if(Storage::disk('upload_attachments')->exists('attachments/library/'.$book->file_name)){
                Storage::disk('upload_attachments')->delete('attachments/library/'.$book->file_name);
                $file_name_new =$request->file_name->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
                $request->file('file_name')->storeAs('attachments/library/',$file_name_new,'upload_attachments');
              }  
            }      

            $book->Grade_id=$request->Grade_id;
            $book->Classroom_id=$request->Classroom_id;
            $book->section_id=$request->section_id;
            $book->teacher_id=1;
            $book->save();
                  
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
         }catch(\Exception $e){
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
}
public function destroy($request){
    Storage::disk('upload_attachments')->delete('attachments/library/'.$request->file_name);

    Library::destroy($request->id);

    toastr()->success(trans('messages.Delete'));
    return redirect()->route('library.index');
}

public function downloadAttachment($name){
    return response()->download(public_path('attachments/library/'.$name));

}

}
