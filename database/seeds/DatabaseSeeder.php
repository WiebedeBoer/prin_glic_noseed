<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //foreign key seeds
        $this->call('Cms_fkeySeeder');
        //language inserts
        $this->call('Cms_languageSeeder');
        //framework inserts
        $this->call('Cms_frameworkSeeder');
        //database inserts
        $this->call('Cms_dbSeeder');
        //table inserts app data     
        $this->call('Cms_appstatusSeeder');
        //table inserts apps
        //$this->call('Cms_appSeeder');
        //table inserts privacy
        //$this->call('Cms_privacySeeder');
        //table inserts server data
        $this->call('Cms_servertypeSeeder');
        $this->call('Cms_serverotapSeeder');
        $this->call('Cms_serverstatusSeeder');
        $this->call('Cms_serverserviceSeeder');
        $this->call('Cms_serverosSeeder');
        //table inserts servers
        //$this->call('Cms_serverSeeder');
        //table inserts persons
        //$this->call('Cms_personsSeeder');
        //server apps
       // $this->call('Cms_ServerAppSeeder');
        //app persons
       // $this->call('Cms_appOwnerSeeder');
        //$this->call('Cms_appFunctionalAdminSeeder');
       // $this->call('Cms_appTechAdminSeeder');
        //roadmap task
        //$this->call('Cms_roadmapTaskSeeder');         
        //roadmap and estimate 
        //$this->call('EstimateSeeder');  
        //$this->call('RoadmapSeeder');         
        //$this->call('RoadmapTypeSeeder'); 
       // $this->call('RoadmapPersonSeeder');
       // $this->call('PersonTaskSeeder'); 
    }
}

//foreign keys
class Cms_fkeySeeder extends Seeder
{
    public function run()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->foreign('app_status')->references('app_status_id')->on('app_status');
            $table->foreign('language_dependency')->references('language_id')->on('languages');
            $table->foreign('framework_dependency')->references('framework_id')->on('frameworks');
            $table->foreign('database_dependency')->references('db_id')->on('databases');
        }); 
        
        Schema::table('servers', function (Blueprint $table) {
            $table->foreign('server_type')->references('server_type_id')->on('server_type');
            $table->foreign('server_otap')->references('server_otap_id')->on('server_otap');
            $table->foreign('server_status')->references('server_status_id')->on('server_status');
            $table->foreign('server_service')->references('server_service_id')->on('server_service');
            $table->foreign('server_operating_system')->references('server_os_id')->on('server_os');
        }); 
        
        Schema::table('app_owner', function (Blueprint $table) {
            $table->foreign('app_id')->references('app_id')->on('apps');
            $table->foreign('app_owner_id')->references('person_id')->on('persons');
        });  

        Schema::table('app_techadmin', function (Blueprint $table) {
            $table->foreign('app_id')->references('app_id')->on('apps');
            $table->foreign('app_techadmin_id')->references('person_id')->on('persons');
        }); 
        
        Schema::table('app_functionaladmin', function (Blueprint $table) {
            $table->foreign('app_id')->references('app_id')->on('apps');
            $table->foreign('app_functionaladmin_id')->references('person_id')->on('persons');
        });  
        
        Schema::table('apps_servers', function (Blueprint $table) {
            $table->foreign('app_id')->references('app_id')->on('apps');
            $table->foreign('server_id')->references('server_id')->on('servers');
            $table->foreign('language_dependency')->references('language_id')->on('languages');
            $table->foreign('framework_dependency')->references('framework_id')->on('frameworks');
            $table->foreign('database_dependency')->references('db_id')->on('databases');
        });

        Schema::table('privacy', function (Blueprint $table) {
            $table->foreign('privacy_id')->references('app_id')->on('apps');
        }); 
        
        Schema::table('estimates', function (Blueprint $table) {
            $table->foreign('server_app_id')->references('id')->on('apps_servers');
        }); 
        
        Schema::table('roadmaps', function (Blueprint $table) {
            $table->foreign('server_app_id')->references('id')->on('apps_servers');
            $table->foreign('estimate_id')->references('estimate_id')->on('estimates');
        }); 

        Schema::table('roadmap_persons', function (Blueprint $table) {
            $table->foreign('serverapp_id')->references('id')->on('apps_servers');
            $table->foreign('roadmap_id')->references('roadmap_id')->on('roadmaps');
            $table->foreign('person_id')->references('person_id')->on('persons');
            $table->foreign('roadmap_type')->references('id')->on('roadmap_types');
        }); 

        Schema::table('roadmap_types', function (Blueprint $table) {
            $table->foreign('serverapp_id')->references('id')->on('apps_servers');
            $table->foreign('roadmap_id')->references('roadmap_id')->on('roadmaps');
            $table->foreign('roadmap_task')->references('task_id')->on('roadmap_tasks');
        }); 

        Schema::table('libraries', function (Blueprint $table) {
            $table->foreign('app_id')->references('app_id')->on('apps');
        });

        Schema::table('library_dependencies', function (Blueprint $table) {
            $table->foreign('library_id')->references('library_id')->on('libraries');
        });

        Schema::table('notificaties', function (Blueprint $table) {
            $table->foreign('person_id')->references('person_id')->on('persons');
        });

    }
}

//roadmap task inserts
class Cms_roadmapTaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('roadmap_tasks')->insert([            
            'roadmap_task' => 'deliverables'          
        ]);

        DB::table('roadmap_tasks')->insert([            
            'roadmap_task' => 'research'          
        ]);

        DB::table('roadmap_tasks')->insert([            
            'roadmap_task' => 'evaluation'          
        ]);

    }
}

//roadmap type mockup seed
class RoadmapTypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('roadmap_types')->insert([            
            'roadmap_id' => '1',
            'serverapp_id' => '1',  
            'roadmap_task' => '1', 
            'roadmap_update' => 'mockup',
            'start_date' => '2020-03-19', 
            'end_date' => '2020-03-29'    
        ]);
    }
}

//roadmap mockup seed
class RoadmapSeeder extends Seeder
{
    public function run()
    {
        DB::table('roadmaps')->insert([            
            'server_app_id' => '1',  
            'estimate_id' => '1', 
            'status' => '1',           
            'milestone_date' => '2020-03-19', 
            'roadmap_release_date' => '2020-03-29',
            'roadmap_update' => 'mockup',  
            'roadmap_release' => 'mockup',  
            'wishes' => 'mockup',  
            'trello_board' => 'https://trello.com/b/'     
        ]);

    }
}

//estimate mockup seed
class EstimateSeeder extends Seeder
{
    public function run()
    {
        DB::table('estimates')->insert([            
            'server_app_id' => '1',  
            'roadmap_id' => '1', 
            'status' => '1', 
            'hour_estimate' => '40',  
            'hour_update' => 'mockup', 
            'trello_board' => 'https://trello.com/b/'             
        ]);
    }
}

//roadmap person mockup seed
class RoadmapPersonSeeder extends Seeder
{
    public function run()
    {
        DB::table('roadmap_persons')->insert([            
            'roadmap_id' => '1',
            'serverapp_id' => '1',  
            'roadmap_type' => '1', 
            'person_id' => '1'          
        ]);

        DB::table('roadmap_persons')->insert([            
            'roadmap_id' => '1',
            'serverapp_id' => '1',  
            'roadmap_type' => '1', 
            'person_id' => '2'          
        ]);

    }
}

//roadmap person task mockup seed
class PersonTaskSeeder extends Seeder
{
    public function run()
    {
        DB::table('person_tasks')->insert([            
            'roadmap_person_id' => '1', 
            'roadmap_id' => '1',  
            'task' => 'mockup', 
            'start_date' => '2020-03-19', 
            'start_time' => '1584576000',
            'end_date' => '2020-03-23',
            'end_time' => '1584921600'       
        ]);

        DB::table('person_tasks')->insert([            
            'roadmap_person_id' => '1', 
            'roadmap_id' => '1',  
            'task' => 'mockup twee', 
            'start_date' => '2020-03-25', 
            'start_time' => '1585094400',
            'end_date' => '2020-03-29',
            'end_time' => '1585440000'       
        ]);

        DB::table('person_tasks')->insert([            
            'roadmap_person_id' => '2', 
            'roadmap_id' => '1',  
            'task' => 'mockup drie', 
            'start_date' => '2020-03-20', 
            'start_time' => '1584662400',
            'end_date' => '2020-03-28',
            'end_time' => '1585353600'       
        ]);

    }
}

//language inserts
class Cms_languageSeeder extends Seeder
{
    public function run()
    {
        DB::table('languages')->insert([            
            'language_name' => 'php'          
        ]);

        DB::table('languages')->insert([            
            'language_name' => 'java'          
        ]);
    }
}

//framework inserts
class Cms_frameworkSeeder extends Seeder
{
    public function run()
    {
        DB::table('frameworks')->insert([            
            'framework_name' => 'laravel'          
        ]);

        DB::table('frameworks')->insert([            
            'framework_name' => 'spring'          
        ]);

        DB::table('frameworks')->insert([            
            'framework_name' => 'hibernate'          
        ]);
    }
}

//framework inserts
class Cms_dbSeeder extends Seeder
{
    public function run()
    {
        
        DB::table('databases')->insert([            
            'db_name' => 'geen'          
        ]);
        
        DB::table('databases')->insert([            
            'db_name' => 'mysql'          
        ]);

        DB::table('databases')->insert([            
            'db_name' => 'sqlite'          
        ]);

        DB::table('databases')->insert([            
            'db_name' => 'mariadb'          
        ]);

        DB::table('databases')->insert([            
            'db_name' => 'mongodb'          
        ]);

        DB::table('databases')->insert([            
            'db_name' => 'postgresql'          
        ]);

        DB::table('databases')->insert([            
            'db_name' => 'oracle'          
        ]);
    }
}

//app data inserts
class Cms_appstatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('app_status')->insert([            
            'app_status' => 'active'          
        ]);

        DB::table('app_status')->insert([            
            'app_status' => 'phased out'          
        ]);

        DB::table('app_status')->insert([            
            'app_status' => 'in preparation'          
        ]);

        DB::table('app_status')->insert([            
            'app_status' => 'unknown'          
        ]);
    }
}

//server data inserts
class Cms_servertypeSeeder extends Seeder
{
    public function run()
    {
        DB::table('server_type')->insert([            
            'server_type' => 'virtuele server'          
        ]);

        DB::table('server_type')->insert([            
            'server_type' => 'fysieke server'          
        ]);

        DB::table('server_type')->insert([            
            'server_type' => 'extern'          
        ]);

        DB::table('server_type')->insert([            
            'server_type' => 'onbekend'          
        ]);
    }
}

//server otap
class Cms_serverotapSeeder extends Seeder
{
    public function run()
    {
        DB::table('server_otap')->insert([            
            'server_otap' => 'ontwikkel'          
        ]);

        DB::table('server_otap')->insert([            
            'server_otap' => 'test'          
        ]);

        DB::table('server_otap')->insert([            
            'server_otap' => 'acceptatie'          
        ]);

        DB::table('server_otap')->insert([            
            'server_otap' => 'productie'          
        ]);

        DB::table('server_otap')->insert([            
            'server_otap' => 'onbekend'          
        ]);
    }
}

//server status
class Cms_serverstatusSeeder extends Seeder
{
    public function run()
    {
        DB::table('server_status')->insert([            
            'server_status' => 'active'          
        ]);

        DB::table('server_status')->insert([            
            'server_status' => 'phased out',
            'server_status_remarks' => 'uitgefaseerde server, draait niet meer'          
        ]);

        DB::table('server_status')->insert([            
            'server_status' => 'unknown',
            'server_status_remarks' => 'onbekende status, uitzoeken'           
        ]);
    }
}

//server service level
class Cms_serverserviceSeeder extends Seeder
{
    public function run()
    {
        DB::table('server_service')->insert([            
            'server_service' => 'Hoge Beschikbaarheid',
            'server_service_description' => 'Hoge Beschikbaarheid = bij storing wordt deze als eerste weer up gebracht'          
        ]);

        DB::table('server_service')->insert([            
            'server_service' => 'Enkelvoudig',
            'server_service_description' => 'Enkelvoudig = bij storing lagere prioriteit'          
        ]);

        DB::table('server_service')->insert([            
            'server_service' => 'SLA',
            'server_service_description' => 'Wordt via SLA geregeld'          
        ]);

        DB::table('server_service')->insert([            
            'server_service' => 'Onbekend',
            'server_service_description' => 'niet bekend, uitzoeken'          
        ]);
    }
}

//server operating system
class Cms_serverosSeeder extends Seeder
{
    public function run()
    {
        //1
        DB::table('server_os')->insert([            
            'server_os_name' => 'Ubuntu 18.04 LTS',
            'code_name' => 'Bionic Beaver',
            'release' => '2018-04-26',
            'end_of_support' => '2023-04-01'            
        ]);
        //2
        DB::table('server_os')->insert([            
            'server_os_name' => 'Ubuntu 16.04 LTS',
            'code_name' => 'Xenial Xerus',
            'release' => '2016-04-21',
            'end_of_support' => '2021-04-01'            
        ]);
        //3
        DB::table('server_os')->insert([            
            'server_os_name' => 'Ubuntu 14.04 LTS',
            'code_name' => 'Trusty Tahr',
            'release' => '2014-04-17',
            'end_of_support' => '2023-04-01'            
        ]);
        //4
        DB::table('server_os')->insert([            
            'server_os_name' => 'Ubuntu 12.04 LTS',
            'code_name' => 'Precise Pangolin',
            'release' => '2012-04-01',
            'end_of_support' => '2017-04-28'            
        ]);
        //5
        DB::table('server_os')->insert([            
            'server_os_name' => 'Ubuntu 10.04 LTS',
            'code_name' => 'Lucid Lynx',
            'release' => '2010-04-01',
            'end_of_support' => '2015-04-30'            
        ]);
        //6
        DB::table('server_os')->insert([            
            'server_os_name' => 'Ubuntu 8.04 LTS',
            'code_name' => 'Hardy Heron (Server)',
            'release' => '2008-04-01',
            'end_of_support' => '2023-05-09'            
        ]);
        //7
        DB::table('server_os')->insert([            
            'server_os_name' => 'Ubuntu 6.06.2 LTS',
            'code_name' => 'Dapper Drake (Server)',
            'release' => '2006-06-01',
            'end_of_support' => '2011-06-01'            
        ]);
        //8
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 10',
            'code_name' => 'Buster',
            'release' => '2019-01-01',
            'end_of_support' => '2022-01-01'            
        ]);
        //9
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 9',
            'code_name' => 'Stretch',
            'release' => '2017-06-17',
            'end_of_support' => '2022-01-01'            
        ]);
        //10
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 8.11',
            'code_name' => 'Jessie',
            'release' => '2015-04-25',
            'end_of_support' => '2020-06-30'            
        ]);
        //11
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 7',
            'code_name' => 'Wheezy',
            'release' => '2013-05-04',
            'end_of_support' => '2018-05-31'            
        ]);
        //12
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 6',
            'code_name' => 'Squeeze',
            'release' => '2011-02-06',
            'end_of_support' => '2016-02-29'            
        ]);
        //13
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 5',
            'code_name' => 'Lenny',
            'release' => '2009-02-14',
            'end_of_support' => '2012-02-06'            
        ]);
        //14
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 4',
            'code_name' => 'Etch',
            'release' => '2007-04-08',
            'end_of_support' => '2010-02-15'            
        ]);
        //15
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 3.1',
            'code_name' => 'Sarge',
            'release' => '2005-06-06',
            'end_of_support' => '2008-03-31'            
        ]);
        //16
        DB::table('server_os')->insert([            
            'server_os_name' => 'Debian 3',
            'code_name' => 'Woody',
            'release' => '2002-07-19',
            'end_of_support' => '2006-06-01'            
        ]);
        //17
        DB::table('server_os')->insert([            
            'server_os_name' => 'Solaris 10',
            'code_name' => 'Nevada',
            'release' => '2005-01-31',
            'end_of_support' => '2024-01-01'            
        ]);
        //18
        DB::table('server_os')->insert([            
            'server_os_name' => 'Solaris 9',
            'code_name' => 'Nevada',
            'release' => '2002-05-08',
            'end_of_support' => '2014-10-01'            
        ]);
        //19
        DB::table('server_os')->insert([            
            'server_os_name' => 'Windows Server',
            'code_name' => 'Viridian',
            'release' => '2008-02-04',
            'end_of_support' => '2020-01-14'            
        ]);
        //20
        DB::table('server_os')->insert([            
            'server_os_name' => 'onbekend',
            'code_name' => 'onbekend',
            'release' => '1970-01-01',
            'end_of_support' => '2099-01-01'            
        ]);
        //21
        DB::table('server_os')->insert([            
            'server_os_name' => 'ESXi',
            'code_name' => 'onbekend',
            'release' => '2001-03-23',
            'end_of_support' => '2099-01-01'            
        ]);
        //22
        DB::table('server_os')->insert([            
            'server_os_name' => 'Sun Oracle',
            'code_name' => 'onbekend',
            'release' => '1992-06-01',
            'end_of_support' => '2099-01-01'            
        ]);
        //23
        DB::table('server_os')->insert([            
            'server_os_name' => 'CentOS Linux 7',
            'code_name' => 'onbekend',
            'release' => '2004-05-14',
            'end_of_support' => '2099-01-01'            
        ]);
    }
}