<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeeInvoice extends Model
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

    public function student()
    {
        return $this->belongsTo('App\Student', 'student_id');
    }

    public function fees()
    {
        return $this->belongsTo('App\Fees', 'fee_id');
    }
}
