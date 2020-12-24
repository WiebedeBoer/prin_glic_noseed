<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoadmapTypes extends Model
{
    //roadmap types tabel
    protected $table = 'roadmap_types';
    protected $primaryKey = 'id';

    //server apps
    public function servers_apps()
    {
        return $this->belongsTo('App\ServerApp','server_app_id');
    }

    //roadmap taak
    public function roadmap_tasks()
    {
        return $this->belongsTo('App\RoadmapTask','roadmap_task');
    }

    /*
    public function persons()
    {
        return $this->belongsTo('App\Person','roadmap_person_id');
    }
    */

    //estimates
    public function estimates()
    {
        return $this->belongsTo('App\Estimate','estimate_id');
    }

    //app many to many
    public function apps()
    {
        return $this->belongsToMany( 'App\Apps', 'apps_servers', 'app_id', 'id');
    }

    //server many to many
    public function servers()
    {
        return $this->belongsToMany( 'App\Servers', 'apps_servers', 'server_id', 'id');
    } 


}
