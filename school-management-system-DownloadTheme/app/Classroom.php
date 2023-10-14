<?php

namespace App;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
    public function grade(){
        return $this->belongsTo('Grade','grade_id');
    }
}
