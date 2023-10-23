<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Grade extends Model
{
    use HasTranslations;
    protected $fillable=['name','notes'];
    public $translatable = ['name'];
    
    public function sections(){
        return $this->hasMany('App\Section');
    }
}
