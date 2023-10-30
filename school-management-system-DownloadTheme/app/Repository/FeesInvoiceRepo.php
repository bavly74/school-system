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
use App\Section;
use App\Specialization;
use App\Student;
use App\StudentAccount;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeesInvoiceRepo implements FeesInvoiceRepoInterface{
    public function index(){
        $Fee_invoices=FeeInvoice::all();
        return view('pages.fees_invoices.index',['Fee_invoices'=>$Fee_invoices]);
    }
   
   

    public function create($id){
        $student=Student::findOrFail($id);
        $fees = Fees::where('Classroom_id',$student->Classroom_id)->get();
        return view('pages.fees_invoices.create',['student'=>$student,'fees'=>$fees]);
    }

    public function store($request){
        $list_fees=$request->List_Fees;
        DB::beginTransaction();
        try{
        foreach($list_fees as $list_fee){
            $feeInvoice=new FeeInvoice();
            $feeInvoice->student_id=$list_fee['student_id'];
            $feeInvoice->invoice_date = date('Y-m-d');
            $feeInvoice->fee_id=$list_fee['fee_id'];
            $feeInvoice->amount=$list_fee['amount'];
            $feeInvoice->description=$list_fee['description'];
            $feeInvoice->Grade_id=$request->Grade_id;
            $feeInvoice->Classroom_id=$request->Classroom_id;
            $feeInvoice->save();

            $StudentAccount = new StudentAccount();
            $StudentAccount->student_id = $list_fee['student_id'];
            $StudentAccount->fee_invoice_id = $feeInvoice->id;
            $StudentAccount->date = date('Y-m-d');
            $StudentAccount->type = 'invoice';
            $StudentAccount->Debit = $list_fee['amount'];
            $StudentAccount->credit = 0.00;
            $StudentAccount->description = $list_fee['description'];
            $StudentAccount->save();
        }
        DB::commit();

        toastr()->success(trans('messages.success'));
        return redirect()->route('fees-invoices.index');
    }catch(\Exception $e){
        DB::rollback();
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
        

    }
    public function show($id){
       
    }

    public function edit($id){
        $fee_invoices=FeeInvoice::findOrFail($id);
        $fees=Fees::all();
        return view('pages.fees_invoices.edit',['fees'=>$fees,'fee_invoices'=>$fee_invoices]);
    }

    public function update($request){
        DB::beginTransaction();
        try{
            $fee_invoices=FeeInvoice::findOrFail($request->id);
            $fee_invoices->amount=$request->amount;
            $fee_invoices->fee_id=$request->fee_id;
            $fee_invoices->description=$request->description;
            $fee_invoices->save();

            $StudentAccount=StudentAccount::where('fee_invoice_id',$request->id)->first();
            $StudentAccount->Debit = $request->amount;
            $StudentAccount->description = $request->description;
            $StudentAccount->save();
            DB::commit();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('fees-invoices.index');
        }catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
       
   }

    public function destroy($request){
        try{
            $fee_invoices=FeeInvoice::findOrFail($request->id)->delete();
            toastr()->error(trans('messages.Delete'));
            return redirect()->route('fees-invoices.index');
    }catch (\Exception $e) {
       
        return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
}



}
