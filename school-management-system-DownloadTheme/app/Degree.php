<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $guarded = [];
    public $timestamps = true;
    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function quizze()
    {
        return $this->belongsTo('App\Quiz', 'quiz_id');
    }
}
