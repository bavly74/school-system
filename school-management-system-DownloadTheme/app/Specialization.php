<?php

namespace App;
use Spatie\Translatable\HasTranslations;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{    use HasTranslations;
    public $translatable = ['name'];
    //
}
