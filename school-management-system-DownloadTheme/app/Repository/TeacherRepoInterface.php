<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface TeacherRepoInterface {
    public function getAllTeachers();

    public function store(Request $r);
}