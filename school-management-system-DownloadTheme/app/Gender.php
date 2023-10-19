<?php

namespace App;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Gender extends Model
{    use HasTranslations;
    protected $guarded=[];
    public $translatable = ['name'];
    //
}
