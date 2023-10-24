<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface StudentRepoInterface {
    public function getStudents();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function delete($request);
    public function getClassrooms($id);
    public function getSections($id);
}
