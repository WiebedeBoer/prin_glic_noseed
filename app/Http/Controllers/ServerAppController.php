<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Apps;
use App\Servers;
use App\ServerApp;
use App\Database;
use App\Framework;
use App\Language;
use App\App_FunctionalAdmin;
use App\Mail\AppNotifyMail;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ServerAppController extends Controller
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
            'server' => 'required',
            'app' => 'required'
        ]);        
        $serverapp = new ServerApp();       
        $serverapp->server_id = request('server');
        $serverapp->app_id = request('app');
        $serverapp->save(); 
        //select a max for auto update
        $maxid = $this->getlast();
        //auto update dependencies 
        $updated = $this->autoupdate($maxid);     
        //return
        return redirect('/serverapps')->with('message', 'Succesvol toegevoegd met dependencies');
    }

    //select a max for auto update
    public function getlast()
    {
        $max_id = Servers::select('id', DB::raw('MAX(id) as maxid'));
        $max_id = $max_id->get();
        return $max_id; 
    }

    //auto update dependencies after store
    public function autoupdate($maxid)
    {
        $serverapp_data = ServerApp::where('id', $maxid)->firstOrFail();
        $app_id = $serverapp_data->app_id;
        $app_data = Apps::where('app_id', $app_id)->firstOrFail();
        $language_dependency = $app_data->language_dependency;
        $language_version = $app_data->language_version;
        $framework_dependency = $app_data->framework_dependency;
        $framework_version = $app_data->framework_version;
        $database_dependency = $app_data->database_dependency;
        
        $appsdata = ([
            'language_dependency' => $language_dependency,
            'language_version' => $language_version,
            'framework_dependency' => $framework_dependency,
            'framework_version' => $framework_version,
            'database_dependency' => $database_dependency         
        ]);
        //mail the respective persons
        $this->mailer($maxid);
        //update
        ServerApp::where('id', $maxid)->update($appsdata);
    }

    public function mailer($id)
    {
        //find the persons
        $serverapps = ServerApp::with('servers','apps')->where('id', $id)->firstOrFail();
        $app_name = $serverapps->apps->app_name;
        $app_id = $serverapps->apps->app_id;
        $server_name = $serverapps->servers->server_name;
        $appfunctionaladmincount = $this->countAppFunctionalAdmin($app_id);
        //check if persons exist
        if ($appfunctionaladmincount >=1){
            //find the persons
            $appfunctionaladmin = App_FunctionalAdmin::with('persons')->where('app_id', $app_id)->get();
            $subject ="prin6 notificatie";
            foreach ($appfunctionaladmin as $functionaladmin)
            {
                $person_mail = $functionaladmin->persons->person_email;
                //run the mails

                if (filter_var($person_mail, FILTER_VALIDATE_EMAIL)) {
                    if (!is_null($person_mail)){
                        Mail::to($person_mail)->send(new ServerAppNotifyMail($app_name,$server_name,$person_mail));
                    }
                }   
            }
        } 
        //run the mails
    }

    //create view
    public function create()
    {      
        $serverapp = new ServerApp();
        $servers = Servers::all();
        $apps = Apps::all();
        $databasedependency = Database::all();
        $frameworkdependency = Framework::all();
        $languagedependency = Language::all();
        return view('serverapps.create', compact('serverapp','servers','apps','databasedependency','frameworkdependency','languagedependency'));        
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'server_id' => 'required',
            'app_id' => 'required',
            'language_dependency' => 'required',
            'language_version' => 'required',
            'framework_dependency' => 'required',
            'framework_version' => 'required',
            'database_dependency' => 'required'          
        ]);
        //notify
        $notify = request('notify');
        if ($notify =="yes"){
            $this->mailer($id);
        }

        ServerApp::where('id', $id)->update($data);
        return redirect('/serverapps')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($id)
    {      
        $serverapp = ServerApp::with('servers')->where('id', $id)->firstOrFail();
        $servers = Servers::all();
        $apps = Apps::all();
        $databasedependency = Database::all();
        $frameworkdependency = Framework::all();
        $languagedependency = Language::all();       
        return view('serverapps.edit', compact('serverapp','servers','apps','databasedependency','frameworkdependency','languagedependency'));       
    }

    //server list
    public function index()
    {       
        $serverapps = ServerApp::with('servers','apps','apps_language','apps_framework','apps_database')->paginate(25);
        return view('serverapps.index', ['serverapps' =>$serverapps,]);        
    }

    //show server
    public function show($id)
    {             
        $serverapp = ServerApp::with('servers','apps','apps_language','apps_framework','apps_database')->where('id', $id)->firstOrFail();
        return view('serverapps.show', compact('serverapp')); 
    }

    //delete server function
    public function destroy($id)
    {
        $serverapp = ServerApp::findOrFail($id);
        $serverapp->delete();    
        return redirect('/serverapps')->with('message', 'Succesvol verwijderd');
    }

    //count functional admins
    private function countAppFunctionalAdmin($app_id)
    {
        $appfunctionaladmincount = App_FunctionalAdmin::where('app_id', $app_id)->count();
        return $appfunctionaladmincount;
    }
}