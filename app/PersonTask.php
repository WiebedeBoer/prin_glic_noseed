<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonTask extends Model
{
    //privacy
    protected $table = 'person_tasks';
    protected $primaryKey = 'id';

    //roadmap persons
    public function persons()
    {
        return $this->belongsTo('App\RoadmapPerson','roadmap_person_id');
    }

    //roadmaps
    public function roadmaps()
    {
        return $this->belongsTo('App\Roadmap','roadmap_id');
    }

}
