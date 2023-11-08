<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Teacher extends Authenticatable
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
