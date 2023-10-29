<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Fees extends Model
{
    use HasTranslations;
    protected $guarded=[];
    protected $translatable=['title'];
    public function grade(){
        return $this->belongsTo('App\Grade','Grade_id');
    }
    public function classroom(){
        return $this->belongsTo('App\Classroom','Classroom_id');
    }
}
