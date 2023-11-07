<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    public function grade()
    {
        return $this->belongsTo('App\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Classroom', 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Section', 'section_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id');
    }

}
