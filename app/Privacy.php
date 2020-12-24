<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privacy extends Model
{
    //privacy
    protected $table = 'privacy';
    protected $primaryKey = 'privacy_id';

    protected $guarded = [];

    //apps
    public function apps()
    {
        return $this->belongsTo('App\Apps','privacy_id');
    } 
}
