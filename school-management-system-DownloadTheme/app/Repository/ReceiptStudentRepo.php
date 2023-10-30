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
use App\FeeInvoice;
use App\Fees;
use App\FundAccount;
use App\ReceiptStudent;
use App\Section;
use App\Specialization;
use App\Student;
use App\StudentAccount;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReceiptStudentRepo implements ReceiptStudentRepoInterface{
    public function index(){
        $receipt_students=ReceiptStudent::all();
        return view('pages.receipt.index',['receipt_students'=> $receipt_students]);
    }
   
   

    public function create($id){
        $student=Student::findOrFail($id);
        return view('pages.receipt.create',['student'=>$student]);
    }

    public function store($request){
      DB::beginTransaction();
        try{    
            $receipt=new ReceiptStudent();
            $receipt->date=date('Y-m-d');
            $receipt->student_id=$request->student_id;
            $receipt->Debit=$request->Debit;
            $receipt->description=$request->description;
            $receipt->save();

            $fundAccount=new FundAccount();
            $fundAccount->date=date('Y-m-d');
            $fundAccount->receipt_id= $receipt->id;
            $fundAccount->Debit=$request->Debit;
            $fundAccount->credit=0.0;
            $fundAccount->description=$request->description;
            $fundAccount->save();

            $studentAccount=new StudentAccount();
            $studentAccount->date=date('Y-m-d');
            $studentAccount->receipt_id= $receipt->id;
            $studentAccount->student_id= $request->student_id;
            $studentAccount->type='receipt';
            $studentAccount->credit=$request->Debit;
            $studentAccount->Debit=0.00;
            $studentAccount->description=$request->description;
            $studentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('receipt-students.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }


    }

    public function show($id){
       
    }

    public function edit($id){
        $receipt_student=ReceiptStudent::findOrFail($id);
        return view('pages.receipt.edit',['receipt_student'=>$receipt_student]);
    }

    public function update($request){
        DB::beginTransaction();
        try{    
            $receipt=ReceiptStudent::findOrFail($request->id);
            $receipt->date=date('Y-m-d');
            $receipt->student_id=$request->student_id;
            $receipt->Debit=$request->Debit;
            $receipt->description=$request->description;
            $receipt->save();

            $fundAccount= FundAccount::where('receipt_id',$request->id)->first();
            $fundAccount->date=date('Y-m-d');
            $fundAccount->receipt_id= $receipt->id;
            $fundAccount->Debit=$request->Debit;
            $fundAccount->credit=0.0;
            $fundAccount->description=$request->description;
            $fundAccount->save();

            $studentAccount=StudentAccount::where('receipt_id',$request->id)->first();
            $studentAccount->date=date('Y-m-d');
            $studentAccount->receipt_id= $receipt->id;
            $studentAccount->student_id= $request->student_id;
            $studentAccount->type='receipt';
            $studentAccount->credit=$request->Debit;
            $studentAccount->Debit=0.00;
            $studentAccount->description=$request->description;
            $studentAccount->save();

            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('receipt-students.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
   }

    public function destroy($request){
        ReceiptStudent::findOrFail($request->id)->delete();
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('receipt-students.index');

}



}
