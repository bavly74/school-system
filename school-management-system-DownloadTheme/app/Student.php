<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Student extends Model
{
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

    public function section(){
        return $this->belongsTo('App\Section','section_id');
    }

    public function images(){
        return $this->morphMany('App\Image','imageable');
    }
}
