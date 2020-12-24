<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificatie extends Model
{
    //notificaties reminders tabel
    protected $table = 'notificaties';
    protected $primaryKey = 'notificatie_id';

    //persons
    public function persons()
    {
        return $this->belongsTo('App\Person','person_id');
    } 

}
