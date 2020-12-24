<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoadmapPerson extends Model
{
    //estimates
    protected $table = 'roadmap_persons';
    protected $primaryKey = 'id';

    //server apps
    public function servers_apps()
    {
        return $this->belongsTo('App\ServerApp','server_app_id');
    }

    //persons
    public function personnel()
    {
        return $this->belongsTo('App\Person','person_id');
    }

    //types
    public function types()
    {
        return $this->belongsTo('App\RoadmapTypes','roadmap_type');
    }

    //app many to many
    public function apps()
    {
        return $this->belongsToMany( 'App\Apps', 'apps_servers', 'app_id', 'app_id');
    }

}
