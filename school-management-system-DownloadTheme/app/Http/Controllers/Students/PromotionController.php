<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\StudentPromotionRepoInterface;
class PromotionController extends Controller
{
    protected $promotions;
    public function __construct(StudentPromotionRepoInterface $promotions)
    {
        $this->promotions=$promotions;

    }
    public function index(){
        return $this->promotions->index();
    }

    public function store(Request $request){
        return $this->promotions->store($request);
    }

    public function create(){
        return $this->promotions->create();
    }

    public function destroy(Request $request){
        return $this->promotions->destroy($request);
    }

}
