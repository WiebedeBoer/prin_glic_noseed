<?php

use Illuminate\Database\Seeder;

class Cms_ServerAppSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //server apps
        DB::table('apps_servers')->insert([
            'server_id' => '6',
            'app_id' => '2'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '6',
            'app_id' => '4'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '6',
            'app_id' => '5'
        ]);
        
        DB::table('apps_servers')->insert([
            'server_id' => '6',
            'app_id' => '6'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '6',
            'app_id' => '7'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '1',
            'app_id' => '9'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '2',
            'app_id' => '9'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '3',
            'app_id' => '1'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '4',
            'app_id' => '1'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '13',
            'app_id' => '1'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '17',
            'app_id' => '1'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '32',
            'app_id' => '36'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '2',
            'app_id' => '21'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '2',
            'app_id' => '49'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '1',
            'app_id' => '37'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '2',
            'app_id' => '37'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '5',
            'app_id' => '37'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '7',
            'app_id' => '8'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '46',
            'app_id' => '10'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '1',
            'app_id' => '27'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '2',
            'app_id' => '27'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '5',
            'app_id' => '27'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '1',
            'app_id' => '38'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '2',
            'app_id' => '38'
        ]);

        DB::table('apps_servers')->insert([
            'server_id' => '5',
            'app_id' => '38'
        ]);

    }
}
