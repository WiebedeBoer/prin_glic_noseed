<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_Owner extends Model
{
    //apps owner
    protected $table = 'app_owner';
    protected $primaryKey = 'id';

    public function apps()
    {
        return $this->belongsTo('App\Apps','app_id');
    }

    public function persons()
    {
        return $this->belongsTo('App\Person','app_owner_id');
    }
}
