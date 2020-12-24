<?php

namespace App;
//use App\App_Status;
use DB;
use Illuminate\Database\Eloquent\Model;

class Apps extends Model
{
    //apps
    protected $table = 'apps';
    protected $primaryKey = 'app_id';

    protected $guarded = [];

    //foreign app status
    public function apps_status()
    {
        return $this->belongsTo('App\App_Status','app_status');
    } 
    
    //app language
    public function apps_language()
    {
        return $this->belongsTo('App\Language','language_dependency');
    } 

    //app server framework
    public function apps_framework()
    {
        return $this->belongsTo('App\Framework','framework_dependency');
    } 

    //app server database
    public function apps_database()
    {
        return $this->belongsTo('App\Database','database_dependency');
    } 

    //libraries
    public function libraries()
    {
        return $this->hasMany('App\Library','library_id');
    }

    //supplier many to many
    public function apps_person_supplier()
    {
        return $this->belongsToMany( 'App\Person', 'app_suppliers', 'app_supplier_id', 'app_id');
    }

    //counting for join
    public function serverapps_count()
    {
        return $this->hasMany('App\ServerApp','app_id');
    }

    //app owners count
    public function appowners_count()
    {
        return $this->hasMany('App\App_Owner','app_id');
    } 

    //app technical admin count
    public function apptechadmins_count()
    {
        return $this->hasMany('App\App_TechAdmin','app_id');
    } 

    //app functional admin count
    public function appfunctionaladmins_count()
    {
        return $this->hasMany('App\App_FunctionalAdmin','app_id');
    } 

    //app suppliers count
    public function appsuppliers_count()
    {
        return $this->hasMany('App\Supplier','app_id');
    } 

    //foreign app suppliers
    public function appsuppliers()
    {
        return $this->hasMany('App\Supplier','app_id');
    } 

    //foreign app owners
    public function appowners()
    {
        return $this->hasMany('App_Owner','app_id');
    } 

    //foreign functional admins
    public function appfunctionaladmins()
    {
        return $this->hasMany('App_FunctionalAdmin','app_id');
    }
    
    //foreign functional admins
    public function apptechladmins()
    {
        return $this->hasMany('App_TechAdmin','app_id');
    } 

    //apps en servers koppel
    public function appservers()
    {
        return $this->hasMany('ServerApp','app_id');
    }

}