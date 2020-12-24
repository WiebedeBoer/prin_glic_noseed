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
use App\Mail\AppNotifyMail;
use App\Mail\ObsoleteNotifyMail;
use Illuminate\Support\Arr;

 
class Crontasker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crontasker:day';
 
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
        $cronmsg = "cron";
        //Log::notice($cronmsg);
        //run the notify check
        $this->checkobsolete();
        $end_of_today = date("Y-m-d");
        $rugmail = "w.e.de.boer@rug.nl";
        $app = "test";
        //Mail::to($rugmail)->send(new ObsoleteNotifyMail($app,$app,$rugmail));
        Mail::to($rugmail)->send(new AppNotifyMail($app,$rugmail));

        /*
        \Mail::queue('emails.appnotify',['app_name'=>$app], function ($message) use($rugmail) {
            $message->from($rugmail, 'test');
            $message->to($rugmail);
        });
        */
    }

    //check if system is old
    public function checkobsolete()
    {
        $end_of_today = date("Y-m-d");
        //count
        $server_obsolete_count = Serveros::where('notification', $end_of_today)->count();


        if ($server_obsolete_count >=1)
        {

            //if old auto send notification
            $servers_obsolete = Serveros::where('notification', $end_of_today)->get();
            foreach($servers_obsolete as $server_obsolete)
            {
                $server_os = $server_obsolete->server_os_id;
                $this->mailer($server_os);
            }
        }
        
    }

    //auto mailer
    public function mailer($id)
    {
        //server count
        $server_count = Servers::where('server_operating_system', $id)->count();
        if ($server_count >=1)
        {
            //servers
            $servers = Servers::where('server_operating_system', $id)->get();
            foreach($servers as $server){
                $server_name = $server->server_name;
                $subject ="prin6 notificatie";
                //apps
                $server_apps = ServerApp::where('server_id', $id)->get();
                //find the apps
                foreach ($server_apps as $serverapp)
                {
                    $app_id = $serverapp->app_id;
                    $app_name = $serverapp->apps->app_name;
                    $appfunctionaladmincount = $this->countAppFunctionalAdmin($app_id);
                    //check if persons exist
                    if ($appfunctionaladmincount >=1){
                        //find the persons
                        $appfunctionaladmin = App_FunctionalAdmin::with('persons')->where('app_id', $app_id)->get();
                        
                        foreach ($appfunctionaladmin as $functionaladmin)
                        {
                            $person_mail = $functionaladmin->persons->person_email;
                            //run the mails
                            if (filter_var($person_mail, FILTER_VALIDATE_EMAIL)) {
                                if (!is_null($person_mail)){
                                Mail::to($person_mail)->send(new ObsoleteNotifyMail($app_name,$server_name,$person_mail));
                            //reminder
                            $notificatie = new Notificatie();       
                            $server->person_id = $functionaladmin->persons->person_id;
                            $ndate = new DateTime('now');
                            $ndate->add(new DateInterval('P60D'));
                            $server->notificatie_date = $ndate;
                            $server->notificatie = "controle van app".$app_name." op server".$server_name;
                            $server->save(); 
                                }
                            }
                        }
                    } 
                    
                    $apptechadmincount = $this->countAppTechAdmin($app_id);
                    if($apptechadmincount >=1){
                        $apptechadmin = App_TechAdmin::with('persons')->where('app_id', $app_id)->get();
                        foreach ($apptechadmin as $techadmin)
                        {
                            $person_techmail = $techadmin->persons->person_email;
                            //run the mails
                            if (filter_var($person_techmail, FILTER_VALIDATE_EMAIL)) {
                                if (!is_null($person_techmail)){
                                Mail::to($person_techmail)->send(new ObsoleteNotifyMail($app_name,$server_name,$person_techmail));
                            //reminder
                            $notificatie = new Notificatie();       
                            $server->person_id = $functionaladmin->persons->person_id;
                            $ndate = new DateTime('now');
                            $ndate->add(new DateInterval('P60D'));
                            $server->notificatie_date = $ndate;
                            $server->notificatie = "controle van app".$app_name." op server".$server_name;
                            $server->save(); 
                                }
                            }                   
                        }
                    }                

                }
            }

        }

    }

        //count app owners
        public function countAppOwner($app_id)
        {
            $appownercount = App_Owner::where('app_id', $app_id)->count();
            return $appownercount;
        }

        //count tech admins
        public function countAppTechAdmin($app_id)
        {
            $apptechadmincount = App_TechAdmin::where('app_id', $app_id)->count();
            return $apptechadmincount;
        }

        //count functional admins
        public function countAppFunctionalAdmin($app_id)
        {
            $appfunctionaladmincount = App_FunctionalAdmin::where('app_id', $app_id)->count();
            return $appfunctionaladmincount;
        }

}