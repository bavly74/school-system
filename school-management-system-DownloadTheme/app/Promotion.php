<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $guarded=[];

    public function student(){
        return $this->belongsTo('App\Student','student_id');
    }
    public function f_grade(){
        return $this->belongsTo('App\Grade','from_grade');
    }

    public function t_grade(){
        return $this->belongsTo('App\Grade','to_grade');
    }


    public function f_classroom(){
        return $this->belongsTo('App\Classroom','from_Classroom');
    }

    public function t_classroom(){
        return $this->belongsTo('App\Classroom','to_Classroom');
    }

    public function f_section(){
        return $this->belongsTo('App\Section','from_section');
    }

    public function t_section(){
        return $this->belongsTo('App\Section','to_section');
    }



}
