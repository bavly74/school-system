<?php

namespace App\Repository;
use App\Library;
use App\Attendance;
use App\Grade;
use App\Student;
use App\Teacher;
use App\Setting;

use Illuminate\Support\Facades\Storage;


class SettingRepo implements SettingRepoInterface{

    public function index(){
        $collection = Setting::all();
        $data['setting']=$collection->flatMap(function($collection){
            return [$collection->key => $collection->value];
        });
       return view('pages.settings.index',$data);
    }


    public function update($request){
        try{
            $info=$request->except('_token','logo');
            foreach ($info as $key=> $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }

            if($request->hasFile('logo')){
                Setting::where('key', 'logo')->update(['value'=>$request->file('logo')->getClientOriginalName()]);

                $request->file('logo')->storeAs('attachments/logo/',$request->logo->getClientOriginalName(),'upload_attachments');
            }
            toastr()->success(trans('messages.success'));
        return redirect()->route('setting.index');
        }catch(\Exception $e){
            return redirect()->back()->with(['errors'=>$e->getMessage()]);
        }
}

public function destroy($request){
    
}


}
