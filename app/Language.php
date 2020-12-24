<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    //languages tabel
    protected $table = 'languages';
    protected $primaryKey = 'language_id';

    //app language
    public function apps_language()
    {
        return $this->hasMany('App\Apps','language_dependency');
    } 

    //server app language
    public function serverapps_language()
    {
        return $this->hasMany('App\ServerApp','language_dependency');
    } 
}
