<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerApp extends Model
{
    //servers
    protected $table = 'apps_servers';
    protected $primaryKey = 'id';

    //apps
    public function apps()
    {
        return $this->belongsTo('App\Apps','app_id');
    }

    //servers
    public function servers()
    {
        return $this->belongsTo('App\Servers','server_id');
    }

    //app language
    public function apps_language()
    {
        return $this->belongsTo('App\Language','language_dependency');
    } 

    //app server framework
    public function apps_framework()
    {
        return $this->belongsTo('App\Framework','framework_dependency');
    } 

    //app server database
    public function apps_database()
    {
        return $this->belongsTo('App\Database','database_dependency');
    } 

}
