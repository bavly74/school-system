<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public function grade(){
        return $this->belongsTo('Grade','grade_id');
    }
}
