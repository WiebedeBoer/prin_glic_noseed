<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryDependency extends Model
{
    //libraries
    protected $table = 'library_dependencies';
    protected $primaryKey = 'dependency_id';

    //app libraries
    public function libraries()
    {
        return $this->belongsTo('App\Library','library_id');
    }
}
