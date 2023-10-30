<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Repository\ProcessingFeesRepoInterface;
use Illuminate\Http\Request;

class ProcessingFeeController extends Controller
{
    protected $processingFee;
    public function __construct(ProcessingFeesRepoInterface $processingFee){
        $this->processingFee=$processingFee;
    }

    public function index(){
        return $this->processingFee->index();
    }
   

    public function create($id){
        return $this->processingFee->create($id);

    }

    public function store(Request $request){
        return $this->processingFee->store($request);

        

    }
    public function show($id){
       
    }

    public function edit($id){
        return $this->processingFee->edit($id);

    }

    public function update(Request $request){
        return $this->processingFee->update($request);

       
   }

    public function destroy(Request $request){
        return $this->processingFee->destroy($request);

          }
}
