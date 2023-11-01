<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentStudent extends Model
{
   public function student(){
    return $this->belongsTo('App\Student','student_id');
   }
}
