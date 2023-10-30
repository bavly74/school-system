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
        return $this->feeInvoice->index();
    }

    public function create($id){
        return $this->feeInvoice->create($id);
    }

    public function store(Request $request){
        return $this->feeInvoice->store($request);

    }

  
    public function edit($id){
        return $this->feeInvoice->edit($id);
    }

    public function update(Request $request){
        return $this->feeInvoice->update($request);
   }

    public function destroy(Request $request){
        return $this->feeInvoice->destroy($request);
    }

    public function show($id){
        return $this->feeInvoice->show($id);
    }
}
