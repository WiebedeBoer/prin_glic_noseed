<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    //libraries
    protected $table = 'libraries';
    protected $primaryKey = 'library_id';

    //apps
    public function apps()
    {
        return $this->belongsTo('App\Apps','app_id');
    }

    //library dependencies within framework
    public function dependencies()
    {
        return $this->hasMany('App\LibraryDependency','library_id');
    }

}
