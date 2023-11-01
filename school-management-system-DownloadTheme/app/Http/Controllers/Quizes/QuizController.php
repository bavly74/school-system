<?php

namespace App\Http\Controllers\Quizes;
use App\Http\Controllers\Controller;
use App\Repository\QuizesRepoInterface;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    protected $quiz;
    public function __construct(QuizesRepoInterface $quiz)
    {
        $this->quiz=$quiz;
        
    }
    public function index(){
       return $this->quiz->index();
    }
   

    public function create(){
        return $this->quiz->create();

    }

    public function store(Request $request){
        return $this->quiz->store($request);

        
    }

    public function show($id){
       
    }

    public function edit($id){
        return $this->quiz->edit($id);

    }

    public function update( Request $request){
        return $this->quiz->update( $request);

}
public function destroy(Request $request){
    return $this->quiz->destroy( $request);

}

}
