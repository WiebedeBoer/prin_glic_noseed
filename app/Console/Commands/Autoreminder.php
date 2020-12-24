<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Serveros;
use App\User;
use App\ServerApp;
use App\Servers;
use App\App_FunctionalAdmin;
use App\App_TechAdmin;
use App\App_Owner;
use App\Notificatie;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Mail;

class Autoreminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autoreminder:day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $end_of_today = date("Y-m-d");
        //count
        $remind_count = Notificatie::where('notificatie_date', $end_of_today)->count();
        if ($remind_count >=1)
        {
            //if old auto send notification
            $reminder = Notificatie::with('persons')->where('notificatie_date', $end_of_today)->get();
            foreach($reminder as $remind)
            {
                $remindmail = $remind->persons->person_mail;
                $remindtext = $remind->notificatie;
                $this->remindmailer($remindmail,$remindtext);
            }
        }
    }

    //auto remind
    public function remindmailer($remindmail,$remindtext){
        $subject ="prin6 notificatie";
        //Mail::to($remindmail)->send(new RemindNotifyMail($remindtext))->use($remindmail, $subject);
        if (filter_var($remindmail, FILTER_VALIDATE_EMAIL)) {
            if (!is_null($remindmail)){
        Mail::to($remindmail)->send(new RemindNotifyMail($remindmail,$remindtext));
            }
        }
    }

}
