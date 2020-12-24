<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serveros extends Model
{
        //server os
        protected $table = 'server_os';
        protected $primaryKey = 'server_os_id';

        public function servers()
        {
            return $this->hasMany(Servers::class);
        }
}
