<?php
namespace App\Repository;

use Illuminate\Http\Request;

interface SettingRepoInterface {
    public function index();
    public function update($request);
    public function destroy($request);
    
}
