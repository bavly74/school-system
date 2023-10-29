<?php

namespace App\Repository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Image;
use App\Gender;
use App\Grade;
use App\MyParent;
use App\Nationality;
use App\Blood;
use App\Classroom;
use App\Fees;
use App\Section;
use App\Specialization;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeesInvoiceRepo implements FeesInvoiceRepoInterface{
    public function index(){
        
    }
    public function create(){
       
    }
    public function store($request){
        

    }

    public function show($id){
        $student=Student::findOrFail($id);
        $fees = Fees::where('Classroom_id',$student->Classroom_id)->get();
        return view('pages.fees_invoices.create',['student'=>$student,'fees'=>$fees]);
    }
    
    public function edit($id){
        
    }

    public function update($request){
        
   }

    public function destroy($request){
       
    }



}
