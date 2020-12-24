<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serverservice extends Model
{
        //server service
        protected $table = 'server_service';
        protected $primaryKey = 'server_service_id';

        public function servers()
        {
            return $this->hasMany(Servers::class);
        }
}
