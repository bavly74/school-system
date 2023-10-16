<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['name'];
protected $guarded=[];
    public function classroom()
    {
        return $this->belongsTo('App\Classroom');
    }
    
}
