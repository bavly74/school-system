<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
protected $guarded=[];

    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }
    
    public function teachers(){
        return $this->belongsToMany('App\Teacher','teacher_section');
    }

    public function grades(){
        return $this->belongsTo('App\Grade','grade_id');
    }
}
