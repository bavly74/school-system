<?php

namespace App\Http\Controllers\Students;
use App\Http\Controllers\Controller;
use App\Repository\LibraryRepoInterface;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    protected $library ;
    public function __construct(LibraryRepoInterface $library){
        $this->library=$library;
    }

    public function index(){
      return $this->library->index();
    }
   
    public function create(){
        return $this->library->create();
    }

    public function store(Request $request){
        return $this->library->store($request);
        
    }

    public function show($id){
       
    }

    public function edit($id){
        return $this->library->edit($id);
    }

    public function update(Request $request){
        return $this->library->update($request);

}
public function destroy(Request $request){
    return $this->library->destroy($request);

}
public function downloadAttachment($name){
    return $this->library->downloadAttachment($name);

}
}
