<?php

namespace App\Http\Controllers\Parent;

use App\Attendance;
use App\Degree;
use App\FeeInvoice;
use App\Http\Controllers\Controller;
use App\MyParent;
use App\ReceiptStudent;
use App\Student;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentDashboardController extends Controller
{
    public function index(){
        $sons=Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.sons.index',['sons'=>$sons]);
    }

    public function getResults($id){
        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error('يوجد خطا في كود الطالب');
            return redirect()->route('sons.index');
        }

        $degrees=Degree::where('student_id',$id)->get();
        if($degrees->isEmpty()){
            toastr()->error('لا توجد نتائج لهذا الطالب');
            return redirect()->route('sons.index');
        }
        return view('pages.parents.sons.results',['degrees'=>$degrees]);

    }

    public function attendance(){
        $students=Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.sons.attendance',['students'=>$students]);
    }

    public function SearchAttendance(Request $request){
        $request->validate([
            'from' => 'required|date|date_format:Y-m-d',
            'to' => 'required|date|date_format:Y-m-d|after_or_equal:from'
        ], [
            'to.after_or_equal' => 'تاريخ النهاية لابد ان اكبر من تاريخ البداية او يساويه',
            'from.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
            'to.date_format' => 'صيغة التاريخ يجب ان تكون yyyy-mm-dd',
        ]);
        $students=Student::where('parent_id',auth()->user()->id)->get();


        if ($request->student_id == 0) {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])->get();
            return view('pages.parents.sons.attendance', compact('Students', 'students'));
        } else {

            $Students = Attendance::whereBetween('attendence_date', [$request->from, $request->to])
                ->where('student_id', $request->student_id)->get();
            return view('pages.parents.sons.attendance', compact('Students', 'students'));

        }
    }

    public function fees(){
        $studentIds=Student::where('parent_id',auth()->user()->id)->get();
        $invoices=FeeInvoice::whereIn('student_id',$studentIds)->get();
        return view('pages.parents.sons.fees',['invoices'=>$invoices]);
    }

    public function receipt($id){
        $invoice=FeeInvoice::where('student_id',$id)->sum('amount');
        $receipts=ReceiptStudent::where('student_id',$id)->get();

        return view('pages.parents.sons.receipts',['receipts'=>$receipts,'invoice'=>$invoice]);
    }


    public function showProfile(){
        $information=MyParent::where('id',auth()->user()->id)->first();

        return view('pages.parents.profile',['information'=>$information]);
    }

    public function updateProfile(Request $request,$id){
        $information = MyParent::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.Update'));

        return view('pages.parents.profile',['information'=>$information]);
    }
}
