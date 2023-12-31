<?php

namespace App;
use Spatie\Translatable\HasTranslations;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class MyParent extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother'];
    protected $table = 'my_parents';
    protected $guarded=[];
   
}
