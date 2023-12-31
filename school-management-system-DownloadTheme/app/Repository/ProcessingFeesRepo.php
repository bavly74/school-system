<?php

namespace App\Repository;
use Illuminate\Support\Facades\DB;
use App\ProcessingFee;
use App\Student;
use App\StudentAccount;

class ProcessingFeesRepo implements ProcessingFeesRepoInterface{
    public function index(){
        $ProcessingFees=ProcessingFee::all();
        return view('pages.processing_fees.index',['ProcessingFees'=> $ProcessingFees]);
        
    }
   

    public function create($id){
        $student=Student::findOrFail($id);
        return view('pages.processing_fees.create',['student'=>$student]);
    }

    public function store($request){
        DB::beginTransaction();
        try{
            $processingFee=new ProcessingFee();
            $processingFee->date=date('Y-m-d');
            $processingFee->student_id=$request->student_id;
            $processingFee->amount=$request->Debit;
            $processingFee->description=$request->description;
            $processingFee->save();

            $studentAccount=new StudentAccount();
            $studentAccount->date=date('Y-m-d');
            $studentAccount->type='processing fee';
            $studentAccount->processing_fee_id=$processingFee->id;
            $studentAccount->student_id=$request->student_id;
            $studentAccount->credit=$request->Debit;
            $studentAccount->Debit=0.00;
            $studentAccount->description=$request->description;
            $studentAccount->save();
            DB::commit();
            toastr()->success(trans('messages.success'));
            return redirect()->route('processing-fees.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
    }


    public function edit($id){
       $ProcessingFee=ProcessingFee::findOrFail($id);
       return view('pages.processing_fees.edit',['ProcessingFee'=>$ProcessingFee]);
    }

    public function update($request){
        
        DB::beginTransaction();
        try{
            $processingFee= ProcessingFee::findOrFail($request->id);;
            $processingFee->date=date('Y-m-d');
            $processingFee->student_id=$request->student_id;
            $processingFee->amount=$request->Debit;
            $processingFee->description=$request->description;
            $processingFee->save();

            $studentAccount=StudentAccount::where('student_id',$request->student_id)->first();
            $studentAccount->date=date('Y-m-d');
            $studentAccount->type='processing fee';
            $studentAccount->processing_fee_id=$processingFee->id;
            $studentAccount->student_id=$request->student_id;
            $studentAccount->credit=$request->Debit;
            $studentAccount->Debit=0.00;
            $studentAccount->description=$request->description;
            $studentAccount->save();
            DB::commit();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('processing-fees.index');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
        
   }

    public function destroy($request){
        ProcessingFee::destroy($request->id);
        toastr()->error(trans('messages.Delete'));
        return redirect()->route('processing-fees.index');
         }


          
    public function show($id){
       
    }
}




