<?php

use Illuminate\Database\Seeder;


//app owner seed
class Cms_appOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('app_owner')->insert([
            'app_owner_id' => '16',
            'app_id' => '2'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '17',
            'app_id' => '7'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '18',
            'app_id' => '7'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '17',
            'app_id' => '4'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '18',
            'app_id' => '4'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '17',
            'app_id' => '6'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '18',
            'app_id' => '6'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '18',
            'app_id' => '5'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '10',
            'app_id' => '9'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '14',
            'app_id' => '1'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '19',
            'app_id' => '11'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '19',
            'app_id' => '36'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '11',
            'app_id' => '37'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '6',
            'app_id' => '8'     
        ]); 

        DB::table('app_owner')->insert([
            'app_owner_id' => '11',
            'app_id' => '38'     
        ]); 

    }

}

//app tech admin seed
class Cms_appFunctionalAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       
        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '25',
            'app_id' => '1'     
        ]);       
       
        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '15',
            'app_id' => '2'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '17',
            'app_id' => '4'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '18',
            'app_id' => '4'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '17',
            'app_id' => '5'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '18',
            'app_id' => '5'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '17',
            'app_id' => '6'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '18',
            'app_id' => '6'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '17',
            'app_id' => '7'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '18',
            'app_id' => '7'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '1',
            'app_id' => '8'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '6',
            'app_id' => '8'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '15',
            'app_id' => '9'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '7',
            'app_id' => '11'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '7',
            'app_id' => '12'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '20',
            'app_id' => '21'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '20',
            'app_id' => '37'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '21',
            'app_id' => '37'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '20',
            'app_id' => '38'     
        ]); 

        DB::table('app_functionaladmin')->insert([
            'app_functionaladmin_id' => '21',
            'app_id' => '38'     
        ]); 

    }

}

//app functional admin seed
class Cms_appTechAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '1',
            'app_id' => '1'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '1',
            'app_id' => '2'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '1',
            'app_id' => '4'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '1',
            'app_id' => '5'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '1',
            'app_id' => '6'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '1',
            'app_id' => '7'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '1',
            'app_id' => '9'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '2',
            'app_id' => '9'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '2',
            'app_id' => '21'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '2',
            'app_id' => '27'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '2',
            'app_id' => '37'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '2',
            'app_id' => '38'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '2',
            'app_id' => '49'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '3',
            'app_id' => '8'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '6',
            'app_id' => '8'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '6',
            'app_id' => '26'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '6',
            'app_id' => '42'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '7',
            'app_id' => '11'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '7',
            'app_id' => '12'     
        ]); 

        DB::table('app_techadmin')->insert([
            'app_techadmin_id' => '7',
            'app_id' => '36'     
        ]); 

    }

}


//persons seed
class Cms_personsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //leeg private

    }
}
