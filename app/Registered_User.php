<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registered_User extends Model
{
    //
    protected $table = 'users';
    protected $primaryKey = 'id';
    //public $incrementing = true;
}
