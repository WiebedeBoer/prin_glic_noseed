<?php

namespace App;
//use App\Apps;
use DB;
use Illuminate\Database\Eloquent\Model;

class App_Status extends Model
{
    //apps status
    protected $table = 'app_status';
    protected $primaryKey = 'app_status_id';

    protected $guarded = [];

    public function apps()
    {
        return $this->hasMany(Apps::class);
    }
}
