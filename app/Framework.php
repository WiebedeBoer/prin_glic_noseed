<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Framework extends Model
{
    //frameworks tabel
    protected $table = 'frameworks';
    protected $primaryKey = 'framework_id';

    //app language
    public function apps_language()
    {
        return $this->hasMany('App\Apps','framework_dependency');
    } 

    //server app language
    public function serverapps_language()
    {
        return $this->hasMany('App\ServerApp','framework_dependency');
    } 
}
