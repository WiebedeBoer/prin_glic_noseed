<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //server types
    protected $table = 'app_suppliers';
    protected $primaryKey = 'id';

    public function apps()
    {
        return $this->belongsTo('App\Apps','app_id');
    }

    public function persons()
    {
        return $this->belongsTo('App\Person','app_supplier_id');
    }
}
