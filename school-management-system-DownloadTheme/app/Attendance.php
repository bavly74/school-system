<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Student;
use App\Gender;
use App\Grade;
use App\Section;

class Attendance extends Model
{
    protected $guarded=[];
    public function students()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }


    public function gender()
    {
        return $this->belongsTo(Gender::class, 'gender_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
