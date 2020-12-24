<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serverstatus extends Model
{
        //server otap
        protected $table = 'server_status';
        protected $primaryKey = 'server_status_id';

        public function servers()
        {
            return $this->hasMany(Servers::class);
        }
}
