<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface StudentGraduatedRepoInterface {
    public function index();
    public function create();
    public function softDelete($request);
    public function return($request);
    public function destroy($request);


}
