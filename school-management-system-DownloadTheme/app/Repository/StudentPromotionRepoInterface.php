<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface StudentPromotionRepoInterface {
    public function index();
    public function store($request);
}
