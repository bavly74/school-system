<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
    use SoftDeletes;
    use HasTranslations;
    protected $guarded=[];
    public $translatable = ['name'];

    public function grade(){
        return $this->belongsTo('App\Grade','Grade_id');
    }

    public function gender(){
        return $this->belongsTo('App\Gender','gender_id');
    }

    public function classroom(){
        return $this->belongsTo('App\Classroom','Classroom_id');
    }

    public function Nationality(){
        return $this->belongsTo('App\Nationality','nationality_id');
    }
    
    public function myparent(){
        return $this->belongsTo('App\MyParent','parent_id');
    }
    
    public function section(){
        return $this->belongsTo('App\Section','section_id');
    }

    public function images(){
        return $this->morphMany('App\Image','imageable');
    }
}
