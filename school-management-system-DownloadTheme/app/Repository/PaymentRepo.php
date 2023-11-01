<?php

namespace App\Repository;
use Illuminate\Support\Facades\DB;
use App\FundAccount;
use App\PaymentStudent;
use App\Student;
use App\StudentAccount;

class PaymentRepo implements PaymentRepoInterface{

    public function index(){
       $payment_students=PaymentStudent::all();
       return view('pages.payments.index',['payment_students'=>$payment_students]);
    }
   
   

    public function create($id){
        $student =Student::findOrFail($id);
        return view('pages.payments.create',['student'=>$student]);
    }

    public function store($request){
        
       DB::beginTransaction();
       try{
        $paymentStudent=new PaymentStudent();
        $paymentStudent->date=date('Y-m-d');
        $paymentStudent->student_id=$request->student_id;
        $paymentStudent->amount=$request->Debit;
        $paymentStudent->description=$request->description;
        $paymentStudent->save();
        
        $studentAccount=new StudentAccount();
        $studentAccount->date=date('Y-m-d');
        $studentAccount->type='payment';
        $studentAccount->payment_id=$paymentStudent->id;
        $studentAccount->student_id=$request->student_id;
        $studentAccount->Debit=$request->Debit;
        $studentAccount->credit=0.00;
        $studentAccount->description=$request->description;
        $studentAccount->save();

        $fundAccount=new FundAccount();
        $fundAccount->date=date('Y-m-d');
        $fundAccount->payment_id=$paymentStudent->id;
        $fundAccount->Debit=0.00;
        $fundAccount->credit=$request->Debit;
        $fundAccount->description=$request->description;
        $fundAccount->save();

        DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('payment.index');

       }catch(\Exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }

    }
   

    public function edit($id){
        $payment_student=PaymentStudent::findOrFail($id);
        return view('pages.payments.edit',['payment_student'=>$payment_student]);
    }

    public function update($request){
        DB::beginTransaction();
       try{
        $paymentStudent= PaymentStudent::findOrFail($request->id);
        $paymentStudent->date=date('Y-m-d');
        $paymentStudent->student_id=$request->student_id;
        $paymentStudent->amount=$request->Debit;
        $paymentStudent->description=$request->description;
        $paymentStudent->save();
        
        $studentAccount= StudentAccount::where('payment_id',$request->id)->first();
        $studentAccount->date=date('Y-m-d');
        $studentAccount->type='payment';
        $studentAccount->payment_id=$paymentStudent->id;
        $studentAccount->student_id=$request->student_id;
        $studentAccount->Debit=$request->Debit;
        $studentAccount->credit=0.00;
        $studentAccount->description=$request->description;
        $studentAccount->save();

        $fundAccount= FundAccount::where('payment_id',$request->id)->first();
        $fundAccount->date=date('Y-m-d');
        $fundAccount->payment_id=$paymentStudent->id;
        $fundAccount->Debit=0.00;
        $fundAccount->credit=$request->Debit;
        $fundAccount->description=$request->description;
        $fundAccount->save();

        DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('payment.index');

       }catch(\Exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
       }

       
   }

    public function destroy($request){
       
}

public function show($request){
    try {
        PaymentStudent::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->back();
    }

    catch (\Exception $e) {
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}

}
