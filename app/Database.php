<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    //database tabel
    protected $table = 'databases';
    protected $primaryKey = 'db_id';

    //app language
    public function apps_language()
    {
        return $this->hasMany('App\Apps','database_dependency');
    } 

    //server app language
    public function serverapps_language()
    {
        return $this->hasMany('App\ServerApp','database_dependency');
    } 
}
