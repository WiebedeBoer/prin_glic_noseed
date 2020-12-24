<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servers;
use App\Servertype;
use App\Serverotap;
use App\Serverstatus;
use App\Serverservice;
use App\Serveros;
use App\ServerApp;
use App\App_FunctionalAdmin;
use App\App_TechAdmin;
use App\App_Owner;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;

class ServerController extends Controller
{
    
    //authenticate
    public function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }
    
    //store function
    public function store()
    {     
        $data = request()->validate([
            'server_name' => 'required|min:3',
            'server_type' => 'required',
            'server_otap' => 'required',
            'server_status' => 'required',
            'server_service' => 'required',
            'server_operating_system' => 'required',
            'server_costs' => 'required',
            'memory_costs' => 'required', 
            'sla_costs' => 'required', 
            'server_acquisition' => 'required|date', 
            'server_termination' => 'required|date', 
            'server_certificate_expiration' => 'required|date', 
            'server_machine' => 'required' 
        ]);        
        $server = new Servers();       
        $server->server_name = request('server_name');
        $server->server_type = request('server_type');
        $server->server_otap = request('server_otap');
        $server->server_status = request('server_status');
        $server->server_service = request('server_service');
        $server->server_operating_system = request('server_operating_system');
        $server->server_remarks = request('server_remarks');
        $server->server_costs = request('server_costs');
        $server->memory_costs = request('memory_costs');
        $server->sla_costs = request('sla_costs');
        $server->server_acquisition = request('server_acquisition');
        $server->server_termination = request('server_termination');
        $server->server_certificate_expiration = request('server_certificate_expiration');
        $server->server_machine = request('server_machine');
        $server->save();       
        //return
        return redirect('/servers')->with('message', 'Succesvol toegevoegd');
    }

    //create view
    public function create()
    {      
        $server = new Servers();
        $servertype = Servertype::all();
        $serverotap = Serverotap::all();
        $serverservice = Serverservice::all(); 
        $serverstatus = Serverstatus::all();   
        $serveros = Serveros::all(); 
        return view('servers.create', compact('server','servertype','serverotap','serverservice','serverstatus','serveros'));        
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'server_name' => 'required|min:3',
            'server_type' => 'required',
            'server_otap' => 'required',
            'statusnotify' => 'nullable',
            'server_status' => 'required',
            'server_service' => 'required',
            'osnotify' => 'nullable',
            'server_operating_system' => 'required',
            'server_costs' => 'required',
            'memory_costs' => 'required', 
            'sla_costs' => 'required', 
            'server_acquisition' => 'required|date', 
            'server_termination' => 'required|date', 
            'server_certificate_expiration' => 'required|date', 
            'server_machine' => 'required'           
        ]);
        //update
        Servers::where('server_id', $id)->update($data);
        //if os changed
        $server_old = Servers::where('server_id', $id)->firstOrFail();
        $server_old_os = $server_old->server_operating_system;
        $server_old_status = $server_old->server_status;
        $server_operating_system = request('server_operating_system');
        $osnotify = request('osnotify');
        $server_status = request('server_status');
        $statusnotify = request('statusnotify');
        // os mailer
        if ($osnotify =="yes"){
            if ($server_old_os !=$server_operating_system)
            {
                $this->mailer($id);
            }
        }
        //status mailer
        if ($statusnotify =="yes"){
            if ($server_old_status !=$server_status)
            {
                $this->statusdown($id);
            }
        }
        //return
        return redirect('/servers')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($server)
    {      
        $server = Servers::where('server_id', $server)->firstOrFail();
        $server_id = $server->server_id;
        $servertype = Servertype::all();
        $serverotap = Serverotap::all(); 
        $serverservice = Serverservice::all(); 
        $serverstatus = Serverstatus::all();   
        $serveros = Serveros::all();   
        
        //servers
        $serverappcount = $this->countserverapp($server_id);
        if ($serverappcount >=1){
            $serverapps = ServerApp::with('apps')->where('server_id', $server_id)->get(); 
        }
        else {
            $serverapps = [];
        }          

        return view('servers.edit', compact('server','servertype','serverotap','serverservice','serverstatus','serveros','serverappcount','serverapps'));       
    }

    //server list
    public function index(Request $request)
    {       
        
        $sorttype = $request->query('sort');

        if ($sorttype =="server_name"){
            $servers = Servers::with('servers_status','servers_os')->orderBy($sorttype,'ASC')->paginate(25);
            $links = $servers->appends(['sortby' => $sorttype])->links();
        }
        elseif ($sorttype =="server_status"){
            $servers = Servers::with('servers_status','servers_os')->orderBy($sorttype,'ASC')->paginate(25);
            $links = $servers->appends(['sortby' => $sorttype])->links();
        }
        elseif ($sorttype =="server_operating_system"){
            $servers = Servers::with('servers_status','servers_os')->orderBy($sorttype,'ASC')->paginate(25);
            $links = $servers->appends(['sortby' => $sorttype])->links();
        }
        else {
            $servers = Servers::with('servers_status','servers_os')->paginate(25);
            $links = '';
        }        
        
        $ndate = new DateTime('now');
        $ldate = $ndate->format('Y');
        $pdate = $ldate + 1;
        return view('servers.index', compact('servers','links','ldate','pdate'));        
    }

    //show server
    public function show($server)
    {             
        $server = Servers::where('server_id', $server)->firstOrFail();
        $server_id = $server->server_id;
        $server_type_id = $server->server_type;
        $server_otap_id = $server->server_otap;
        $server_service_id = $server->server_service;
        $server_status_id = $server->server_status;
        $server_os_id = $server->server_operating_system;
        $servertype = Servertype::where('server_type_id', $server_type_id)->firstOrFail();
        $serverotap = Serverotap::where('server_otap_id', $server_otap_id)->firstOrFail();
        $serverservice = Serverservice::where('server_service_id', $server_service_id)->firstOrFail();
        $serverstatus = Serverstatus::where('server_status_id', $server_status_id)->firstOrFail(); 
        $serveros = Serveros::where('server_os_id', $server_os_id)->firstOrFail(); 
        
        //servers
        $serverappcount = $this->countserverapp($server_id);
        if ($serverappcount >=1){
            $serverapps = ServerApp::with('apps')->where('server_id', $server_id)->get(); 
        }
        else {
            $serverapps = [];
        }        

        return view('servers.show', compact('server','servertype','serverotap','serverservice','serverstatus','serveros','serverappcount','serverapps')); 
    }

    //delete server function
    public function destroy($id)
    {
        $server = Servers::findOrFail($id);
        $server->delete();    
        return redirect('/servers')->with('message', 'Succesvol verwijderd');
    }

    //run mail if status down
    public function statusdown($id)
    {
        //if down auto send notification
        $this->downmailer($id);
    }

    //count app servers
    private function countserverapp($server_id)
    {
        $serverappcount = ServerApp::where('server_id', $server_id)->count();
        return $serverappcount;
    }

    //auto mailer is server status changed
    private function downmailer($id)
    {
        //server
        $server = Servers::with('servers_status')->where('server_id', $id)->firstOrFail();
        $server_name = $server->server_name;
        $server_status = $server->servers_status->server_status;
        //apps
        $server_apps = ServerApp::where('server_id', $id)->get();

        //find the apps
        foreach ($server_apps as $serverapp)
        {
            $app_id = $serverapp->app_id;
            $subject ="prin6 notificatie";
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
                            Mail::to($person_mail)->send(new DownNotifyMail($server_status,$server_name,$person_mail));
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
                            Mail::to($person_techmail)->send(new DownNotifyMail($server_status,$server_name,$person_techmail));
                        }
                    }                   
                }
            }
            

        }
    } 

    //check if os is changed
    //auto mailer
    private function mailer($id)
    {
        //server
        $server = Servers::where('server_id', $id)->firstOrFail();
        $server_name = $server->server_name;
        //apps
        $server_apps = ServerApp::where('server_id', $id)->get();
        //find the apps
        foreach ($server_apps as $serverapp)
        {
            $app_id = $serverapp->app_id;
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
                            Mail::to($person_mail)->send(new OSnotifyMail($app_name,$server_name,$person_mail));
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
                            Mail::to($person_techmail)->send(new OSnotifyMail($app_name,$server_name,$person_techmail));
                        }
                    }                   
                }
            }

        }
    }

        //count app owners
        private function countAppOwner($app_id)
        {
            $appownercount = App_Owner::where('app_id', $app_id)->count();
            return $appownercount;
        }

        //count tech admins
        private function countAppTechAdmin($app_id)
        {
            $apptechadmincount = App_TechAdmin::where('app_id', $app_id)->count();
            return $apptechadmincount;
        }

        //count functional admins
        private function countAppFunctionalAdmin($app_id)
        {
            $appfunctionaladmincount = App_FunctionalAdmin::where('app_id', $app_id)->count();
            return $appfunctionaladmincount;
        }

    
}