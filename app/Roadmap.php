<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roadmap extends Model
{
    //estimates
    protected $table = 'roadmaps';
    protected $primaryKey = 'roadmap_id';

    //server apps
    public function servers_apps()
    {
        return $this->belongsTo('App\ServerApp','server_app_id');
    }

    //estimates
    public function estimates()
    {
        return $this->belongsTo('App\Estimate','estimate_id');
    }

    //app owners count
    public function proadmap_persons()
    {
        return $this->hasMany('App\RoadmapPerson','roadmap_id');
    } 

    //app many to many
    public function apps()
    {
        return $this->belongsToMany( 'App\Apps', 'apps_servers', 'app_id', 'app_id');
    }

    //server many to many
    public function servers()
    {
        return $this->belongsToMany( 'App\Servers', 'apps_servers', 'server_id', 'server_id');
    }    

}
