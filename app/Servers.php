<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Servers extends Model
{
    //servers
    protected $table = 'servers';
    protected $primaryKey = 'server_id';

    //status column
    public function servers_status()
    {
        return $this->belongsTo('App\Serverstatus','server_status');
    }

    //service column
    public function servers_service()
    {
        return $this->belongsTo('App\Serverservice','server_service');
    }
    
    //os column
    public function servers_os()
    {
        return $this->belongsTo('App\Serveros','server_operating_system');
    }  

    //counting for join
    public function serverapps_count()
    {
        return $this->hasMany('App\ServerApp','server_id');
    }

    //server apps
    public function serverapps()
    {
        return $this->hasMany('App\ServerApp','server_id');
    }
}
