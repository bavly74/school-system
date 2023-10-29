<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Repository\FeesInvoiceRepoInterface;
use Illuminate\Http\Request;

class FeeInvoiceController extends Controller
{
    protected $feeInvoice;
    public function __construct(FeesInvoiceRepoInterface $feeInvoice)
    {
        $this->feeInvoice=$feeInvoice;
        
    }
   
    public function index(){
        
    }
    public function create(){
       
    }
    public function store($request){
        

    }

    public function show($id){
        return $this->feeInvoice->show($id);
    }
    
    public function edit($id){
        
    }

    public function update($request){
        
   }

    public function destroy($request){
       
    }
}
