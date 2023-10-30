<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Repository\ReceiptStudentRepoInterface;
use Illuminate\Http\Request;

class ReceiptStudentController extends Controller
{
    protected $receipt ;
    public function __construct(ReceiptStudentRepoInterface $receipt)
    {
        $this->receipt=$receipt;
        
    }

    public function index(){
        return $this->receipt->index();
    }
   
   

    public function create($id){
        return $this->receipt->create($id);
    }

    public function store(Request $request){
        return $this->receipt->store($request);
    }

    public function show($id){
       
    }

    public function edit($id){
         return $this->receipt->edit($id);
    }

    public function update(Request $request){
        return $this->receipt->update($request);
   }

    public function destroy(Request $request){
        return $this->receipt->destroy($request);
}


}
