<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    //estimates
    protected $table = 'estimates';
    protected $primaryKey = 'estimate_id';

    //server apps
    public function servers_apps()
    {
        return $this->belongsTo('App\ServerApp','server_app_id');
    }

    //roadmaps
    public function roadmaps()
    {
        return $this->belongsTo('App\Roadmap','roadmap_id');
    }

    
    //app many to many
    public function apps()
    {
        return $this->belongsToMany( 'App\Apps', 'apps_servers', 'app_id', 'app_id');
        //$this->belongsToMany( 'App\Apps');
        //return $this->belongsToMany( 'App\ServerApp', 'apps', 'app_id', 'server_app_id');
        //return $this->belongsToMany('App\Role', 'role_user', 'user_id', 'role_id');
    }

    //server many to many
    public function servers()
    {
        return $this->belongsToMany( 'App\Servers', 'apps_servers', 'server_id', 'server_id');
        //return $this->belongsToMany( 'App\ServerApp', 'servers', 'server_id', 'server_app_id');
        //return $this->belongsToMany( 'App\Servers');
    } 
    
    
     

    /*
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
    */
    
    

}
