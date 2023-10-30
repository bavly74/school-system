<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcessingFee extends Model
{
    public function student(){
        return $this->belongsTo('App\Student','student_id');
    }
}
