<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_FunctionalAdmin extends Model
{
    //apps tech admin
    protected $table = 'app_functionaladmin';
    protected $primaryKey = 'id';

    public function apps()
    {
        return $this->belongsTo('App\Apps','app_id');
    }

    public function persons()
    {
        return $this->belongsTo('App\Person','app_functionaladmin_id');
    }
}
