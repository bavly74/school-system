<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineClass extends Model
{
    protected $guarded=[];
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
