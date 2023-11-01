<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Repository\PaymentRepoInterface;
use Illuminate\Http\Request;

class PaymentStudentController extends Controller
{
    
    protected $payment;
    public function __construct(PaymentRepoInterface $payment)
    {
        $this->payment=$payment;
        
    }
    public function index(){
        return $this->payment->index();
    }

    public function create($id){
        return $this->payment->create($id);
    }

    public function store(Request $request){
        return $this->payment->store($request);

    }

  
    public function edit($id){
        return $this->payment->edit($id);
    }

    public function update(Request $request){
        return $this->payment->update($request);
   }

    public function destroy(Request $request){
        return $this->payment->destroy($request);
    }

    public function show($id){
        return $this->payment->show($id);
    }
}




