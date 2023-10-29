<?php

namespace App\Http\Controllers\Students;
use App\Repository\StudentGraduatedRepoInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GraduatesController extends Controller
{
    protected $graduate;
    public function __construct(StudentGraduatedRepoInterface $graduate){
        $this->graduate=$graduate;
    }
   public function index(){
    return $this->graduate->index();
   }

   public function create(){
    return $this->graduate->create();
   }

   public function store(Request $request){
    return $this->graduate->softDelete($request);
}

public function update(Request $request){
    return $this->graduate->return($request);
}

public function destroy(Request $request){
    return $this->graduate->destroy($request);
}

}
