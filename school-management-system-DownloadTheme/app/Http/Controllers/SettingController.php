<?php

namespace App\Http\Controllers;
use App\Repository\SettingRepoInterface;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $setting;
    public function __construct(SettingRepoInterface $setting){
        $this->setting=$setting;
    }

    public function index(){
       return $this->setting->index();
    }

    public function update(Request $request){
        return $this->setting->update($request);

    }

public function destroy(Request $request){
    return $this->setting->destroy($request);
}

}
