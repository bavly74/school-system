<?php

namespace App\Http\Controllers\Exams;
use App\Http\Controllers\Controller;
use App\Repository\ExamsRepoInterface;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    protected $exam;
    public function __construct(ExamsRepoInterface $exam)
    {
        $this->exam=$exam;
    }
    public function index(){
        return $this->exam->index();
    }
    public function create(){
        return $this->exam->create();

    }
    public function store(Request $request){
        return $this->exam->store($request);

    }
    public function show($id){
        return $this->exam->show($id);

    }

    public function edit($id){
        return $this->exam->edit($id);

    }
    public function update(Request $request){
        return $this->exam->update($request);

    }
    public function destroy(Request $request){
        return $this->exam->destroy($request);

    }
}
