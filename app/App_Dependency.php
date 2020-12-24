<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_Dependency extends Model
{
    //apps owner
    protected $table = 'app_dependencies';
    protected $primaryKey = 'id';

    public function apps()
    {
        return $this->belongsTo('App\Apps','app_id');
    }

    public function dependent_apps()
    {
        return $this->belongsTo('App\Apps','dependent_app_id');
    }
}
