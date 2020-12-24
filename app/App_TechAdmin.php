<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_TechAdmin extends Model
{
    //apps tech admin
    protected $table = 'app_techadmin';
    protected $primaryKey = 'id';

    public function apps()
    {
        return $this->belongsTo('App\Apps','app_id');
    }

    public function persons()
    {
        return $this->belongsTo('App\Person','app_techadmin_id');
    }
}
