<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface ProcessingFeesRepoInterface {
    public function index();
    public function create($id);
    public function store($request);
    public function show($id);
    
    public function edit($id);
    public function update($request);
    public function destroy($request);
    
}
