<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Subject extends Model
{
    use HasTranslations;
    protected $guarded=[];
    protected $translatable=['name'];
    public function grade(){
        return $this->belongsTo('App\Grade','grade_id');
    }

    public function classroom(){
        return $this->belongsTo('App\Classroom','classroom_id');
    }

    public function teacher(){
        return $this->belongsTo('App\Teacher','teacher_id');
    }
}
