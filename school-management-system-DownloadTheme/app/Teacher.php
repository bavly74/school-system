<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Model
{
    use HasTranslations;
    protected $guarded=[];
    public $translatable = ['Name'];
    
    public function sections (){
        return $this->belongsToMany('App\Section','teacher_section');
    }

    public function genders (){
        return $this->belongsTo('App\Gender','Gender_id');
    }

    public function specializations (){
        return $this->belongsTo('App\Specialization','Specialization_id');
    }
    
}
