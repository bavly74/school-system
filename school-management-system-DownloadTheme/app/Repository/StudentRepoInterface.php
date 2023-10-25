<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface StudentRepoInterface {
    public function getStudents();
    public function create();
    public function store($request);
    public function show($id);
    public function upload_attachment($request);
    public function Download_attachment($studentName,$fileName);
    public function deleteAttachment($request);
    public function edit($id);
    public function update($request);
    public function delete($request);
    public function getClassrooms($id);
    public function getSections($id);
}
