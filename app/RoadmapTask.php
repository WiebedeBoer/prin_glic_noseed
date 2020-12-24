<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoadmapTask extends Model
{
    //estimates
    protected $table = 'roadmap_tasks';
    protected $primaryKey = 'task_id';

    //roadmap types
    public function roadmap_types()
    {
        return $this->hasMany('App\RoadmapTypes','roadmap_task');
    } 
}
