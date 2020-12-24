<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
        //persons tabel
        protected $table = 'persons';
        protected $primaryKey = 'person_id';

        //app owners count
        public function appowners_count()
        {
                return $this->hasMany('App\App_Owner','app_owner_id');
        } 

        //app technical admin count
        public function apptechadmins_count()
        {
                return $this->hasMany('App\App_TechAdmin','app_techadmin_id');
        } 

        //app functional admin count
        public function appfunctionaladmins_count()
        {
                return $this->hasMany('App\App_FunctionalAdmin','app_functionaladmin_id');
        } 

        //app suppliers count
        public function appsuppliers_count()
        {
                return $this->hasMany('App\Supplier','app_supplier_id');
        } 
}
