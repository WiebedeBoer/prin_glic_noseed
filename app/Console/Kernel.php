<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use DateTime;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Crontasker::class,
        Commands\Autoreminder::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        //$schedule->command('crontasker:day')->daily();
        //$schedule->command('autoreminder:day')->daily();

        //$schedule->command('crontasker:day')->dailyAt('23:00');
        //$schedule->command('autoreminder:day')->dailyAt('23:00');

        $schedule->command('crontasker:day')->everyMinute();
        $schedule->command('autoreminder:day')->everyMinute();

        //$schedule->exec('node /home/forge/script.js')->daily();

        //$controller = app()->make('App\Http\Controllers\ServerOSController');
        //app()->call([$controller, 'crontasker'], []);

        //$schedule->call('\App\Http\Controllers\ServerOSController@crontasker')->cron('* * * * *');
        //$schedule->call('\App\Http\Controllers\ServerOSController@crontasker')->daily();
        //$schedule->call('\App\Http\Controllers\ServerOSController@autoreminder')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
