<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;
use App\Apps;
use App\App_Status;
use App\App_Owner;
use App\App_TechAdmin;
use App\App_FunctionalAdmin;
use App\Supplier;
use App\Person;
use App\Database;
use App\Framework;
use App\Language;
use App\Privacy;
use App\Library;
use App\ServerApp;
use App\Servers;
use App\App_Dependency;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use App\Mail\AppNotifyMail;

class AppsController extends Controller
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
                'app_name' => 'required|min:2',
                'app_status' => 'required',
                'app_url' => 'nullable|url',
                'language_dependency' => 'required',
                'language_version' => 'required',
                'framework_dependency' => 'required',
                'framework_version' => 'required',
                'database_dependency' => 'required',
                'privacy_status' => 'required',
                'dvo' => 'nullable',
                'dvo_link' => 'nullable|url',
                'sla' => 'nullable',
                'sla_link' => 'nullable|url',
                'app_remarks' => 'nullable'
            ]);
            
            $apps = new Apps();       
            $apps->app_name = request('app_name');
            $apps->app_status = request('app_status');
            $apps->app_url = request('app_url');

            $apps->language_dependency = request('language_dependency');
            $apps->language_version = request('language_version');
            $apps->framework_dependency = request('framework_dependency');
            $apps->framework_version = request('framework_version');
            $apps->database_dependency = request('database_dependency');
            $apps->privacy_status = request('privacy_status');

            $apps->dvo_link = request('dvo_link');
            $apps->dvo = request('dvo');
            $apps->sla_link = request('sla_link');
            $apps->sla = request('sla');

            $apps->app_remarks = request('app_remarks');
            $apps->save(); 

            //get last app
            $last_app_id = DB::table('apps')->max('app_id');

            //server multi
            $server_data = request()->input('servers');     
            
            if( !empty( $server_data)){
                foreach($server_data as $server)
                {
                    $serverapp = new ServerApp();       
                    $serverapp->server_id = $server;
                    $serverapp->app_id = $last_app_id;
                    $serverapp->save(); 
                }
            }      

            //owner multi
            $appowner_data = request()->input('appowners');
            
            if( !empty( $appowner_data)){
                foreach($appowner_data as $owner_data)
                {
                    $appowner = new App_Owner();  
                    $appowner->app_owner_id = $owner_data;
                    $appowner->app_id = $last_app_id;
                    $appowner->save();  
                }
            }  

            //functional admin multi
            $appfunctionaladmin_data = request()->input('appfunctionaladmins');
            
            if( !empty( $appfunctionaladmin_data)){
                foreach($appfunctionaladmin_data as $functionaladmin_data)
                {
                    $appfunctionaladmin = new App_FunctionalAdmin();  
                    $appfunctionaladmin->app_functionaladmin_id = $functionaladmin_data;
                    $appfunctionaladmin->app_id = $last_app_id;
                    $appfunctionaladmin->save(); 
                }
            }
                  
            //tech admin multi
            $apptechadmin_data = request()->input('apptechadmins');
            if( !empty( $apptechadmin_data)){
                foreach($apptechadmin_data as $techadmin_data)
                {
                    $apptechadmin = new App_TechAdmin();  
                    $apptechadmin->app_techadmin_id = $techadmin_data;
                    $apptechadmin->app_id = $last_app_id;
                    $apptechadmin->save(); 
                }  
            }
            
            //supplier multi
            $appsupplier_data = request()->input('appsuppliers');
            if( !empty( $appsupplier_data)){
                foreach($appsupplier_data as $supplier_data)
                {
                    $appsupplier = new Supplier();  
                    $appsupplier->app_supplier_id = $supplier_data;
                    $appsupplier->app_id = $last_app_id;
                    $appsupplier->save();    
                }
            }         
            
            //insert privacy
            DB::table('privacy')->insert([
                'terms' => 'geen opmerkingen'
            ]);
         
            //return
            return redirect('/apps')->with('message', 'Succesvol ingevoerd ');
            
        }

        //create view
        public function create()
        {      
            $apps = new Apps();
            $appstatus = App_Status::all();
            $databasedependency = Database::all();
            $frameworkdependency = Framework::all();
            $languagedependency = Language::all();
            
            //servers
            $servers = Servers::with('serverapps')->orderBy('server_name','ASC')->get();

             //persons
             $persons = Person::orderBy('person_name','ASC')->get();           
            
            return view('apps.create', compact('apps',
            'servers',
            'persons',
            'appstatus',
            'databasedependency',
            'frameworkdependency',
            'languagedependency'));           

        }

        //update function
        public function update(Request $request, $app_id)
        {
            $data = $request->validate([
                'app_name' => 'required|min:2',
                'app_status' => 'required',
                'app_url' => 'nullable|url',
                'language_dependency' => 'required',
                'language_version' => 'required',
                'framework_dependency' => 'required',
                'framework_version' => 'required',
                'database_dependency' => 'required',
                'privacy_status' => 'required',
                'dvo' => 'nullable',
                'dvo_link' => 'nullable|url',
                'sla' => 'nullable',
                'sla_link' => 'nullable|url',
                'app_remarks' => 'nullable'         
            ]);
            Apps::where('app_id',$app_id)->update($data);

            //server multi
            $server_data = request()->input('servers');
            //owner multi
            $appowner_data = request()->input('appowners');
            //tech admin multi
            $apptechadmin_data = request()->input('apptechadmins');
            //functional admin multi
            $appfunctionaladmin_data = request()->input('appfunctionaladmins');
            //supplier multi
            $appsupplier_data = request()->input('appsuppliers');

            //servers
            $servers = Servers::with('serverapps')->orderBy('server_name','ASC')->get();

            //servers
            foreach($servers as $server)
            {
                $servercount = ServerApp::with('servers')->where('app_id',$app_id)->where('server_id',$server->server_id)->count();
                if($servercount ==1)
                {
                    if (in_array($server->server_id, $server_data)) {
                        //is unchanged
                    } 
                    else {
                        //remove deselected
                        $serverapp = ServerApp::where('server_id', $server->server_id)->where('app_id',$app_id)->firstOrFail();
                        $serverapp->delete(); 
                    }
                }
                else 
                {
                    
                    if (is_array($server_data))
                    {
                        //create selected newly added
                        if (in_array($server->server_id, $server_data)) {
                            $serverapp = new ServerApp();       
                            $serverapp->server_id = $server->server_id;
                            $serverapp->app_id = $app_id;
                            $serverapp->save(); 
                        } 
                    }
                 
                }
            } 

            //persons
            $persons = Person::orderBy('person_name','ASC')->get();

            //persons
            foreach($persons as $person)
            {
                $ownercount = App_Owner::with('persons')->where('app_id',$app_id)->where('app_owner_id',$person->person_id)->count();
                if($ownercount ==1)
                {
                    if (is_array($appowner_data)) {
                    if (in_array($person->person_id, $appowner_data)) {
                        //is unchanged
                    } 
                    else
                    {
                        //remove deselected
                        $appowner = App_Owner::where('app_id',$app_id)->where('app_owner_id',$person->person_id)->firstOrFail();
                        $appowner->delete();
                    }
                    }                  
                }
                else 
                {                 
                    if (is_array($appowner_data)) {
                        //create selected newly added
                        if (in_array($person->person_id, $appowner_data)) {
                            $appowner = new App_Owner();  
                            $appowner->app_owner_id = $person->person_id;
                            $appowner->app_id = $app_id;
                            $appowner->save(); 
                        }  
                    }                  
                }
                $fadmincount = App_FunctionalAdmin::with('persons')->where('app_id',$app_id)->where('app_functionaladmin_id',$person->person_id)->count();
                if($fadmincount ==1)
                {
                    if(is_array($appfunctionaladmin_data)){
                        if (in_array($person->person_id, $appfunctionaladmin_data)) {
                            //is unchanged
                        } 
                        else
                        {
                            //remove deselected
                            $functionaladmin = App_FunctionalAdmin::where('app_id',$app_id)->where('app_functionaladmin_id',$person->person_id)->firstOrFail();
                            $functionaladmin->delete();
                        } 
                    }
                    
                }
                else 
                {
                     
                    if(is_array($appfunctionaladmin_data))
                    {
                        //create selected newly added
                        if (in_array($person->person_id, $appfunctionaladmin_data)) {
                            $appfunctionaladmin = new App_FunctionalAdmin();  
                            $appfunctionaladmin->app_functionaladmin_id = $person->person_id;
                            $appfunctionaladmin->app_id = $app_id;
                            $appfunctionaladmin->save(); 
                        } 
                    }
                     
                }
                $tadmincount = App_TechAdmin::with('persons')->where('app_id',$app_id)->where('app_techadmin_id',$person->person_id)->count();
                if($tadmincount ==1)
                {
                    if(is_array($apptechadmin_data)){
                        if (in_array($person->person_id, $apptechadmin_data)) {
                            //is unchanged
                        } 
                        else
                        {
                            //remove deselected
                            $techadmin = App_TechAdmin::where('app_id',$app_id)->where('app_techadmin_id',$person->person_id)->firstOrFail();
                            $techadmin->delete();
                        } 
                    }
                   
                }
                else 
                {
                    if(is_array($apptechadmin_data))
                    {
                        //create selected newly added
                        if (in_array($person->person_id, $apptechadmin_data)) {
                            $apptechadmin = new App_TechAdmin();  
                            $apptechadmin->app_techadmin_id = $person->person_id;
                            $apptechadmin->app_id = $app_id;
                            $apptechadmin->save();  
                        }
                    }
                    
                   
                }
                $suppliercount = Supplier::with('persons')->where('app_id',$app_id)->where('app_supplier_id',$person->person_id)->count();
                if($suppliercount ==1)
                {
                    if(is_array($appsupplier_data)){
                        if (in_array($person->person_id, $appsupplier_data)) {
                            //is unchanged
                        } 
                        else
                        {
                            //remove deselected
                            $supplier = Supplier::where('app_id',$app_id)->where('app_supplier_id',$person->person_id)->firstOrFail();
                            $supplier->delete();
                        } 
                    }
                    
                }
                else 
                {
                    if(is_array($appsupplier_data))
                    {
                        //create selected newly added
                        if (in_array($person->person_id, $appsupplier_data)) {
                            $appsupplier = new Supplier();  
                            $appsupplier->app_supplier_id = $person->person_id;
                            $appsupplier->app_id = $app_id;
                            $appsupplier->save();  
                        } 
                    }
                    
                    
                   
                }

            }            

            //mail that there is changes
            //notify
            $notify = request('notify');
            if ($notify =="yes"){
                $this->mailer($app_id);
            }

            return redirect('/apps')->with('message', 'Succesvol gewijzigd');
        }

        //edit view
        public function edit($apps)
        {      
            $apps = Apps::where('app_id', $apps)->firstOrFail();
            $app_id = $apps->app_id; 
            $appstatus = App_Status::all(); 
            $databasedependency = Database::all();
            $frameworkdependency = Framework::all();
            $languagedependency = Language::all();
            //app owner
            $appownercount = $this->countAppOwner($app_id);
            if ($appownercount >=1){
                $appowner = App_Owner::with('apps','persons')->where('app_id', $app_id)->get();
                foreach($appowner as $owners){
                    if($owners->hours == 0){
                        $owners->fte = 0;
                    }
                    else {
                        $owners->fte = round($owners->hours / 40, 2);
                    }
                }
            }
            else {
                $appowner = [];
            }
            //app tech admin
            $apptechadmincount = $this->countAppTechAdmin($app_id);
            if ($apptechadmincount >=1){
                $apptechadmin = App_TechAdmin::with('apps','persons')->where('app_id', $app_id)->get();
                foreach($apptechadmin as $techadmins){
                    if($techadmins->hours == 0){
                        $techadmins->fte = 0;
                    }
                    else {
                        $techadmins->fte = round($techadmins->hours / 40, 2);
                    }
                }        
            }
            else {
                $apptechadmin = [];
            }
            //app functional admin
            $appfunctionaladmincount = $this->countAppFunctionalAdmin($app_id);
            if ($appfunctionaladmincount >=1){
                $appfunctionaladmin = App_FunctionalAdmin::with('apps','persons')->where('app_id', $app_id)->get();  
                foreach($appfunctionaladmin as $functionaladmins){
                    if($functionaladmins->hours == 0){
                        $functionaladmins->fte = 0;
                    }
                    else {
                        $functionaladmins->fte = round($functionaladmins->hours / 40, 2);
                    }
                }          
            }
            else {
                $appfunctionaladmin = [];
            }
            //app supplier
            $appsuppliercount = $this->countAppSupplier($app_id);
            if ($appsuppliercount >=1){
                $appsupplier = Supplier::with('apps','persons')->where('app_id', $app_id)->get(); 
            }
            else {
                $appsupplier = [];
            }
            //libraries
            $librarycount = $this->countlibrary($app_id);
            if ($librarycount >=1){
                $libraries = Library::with('apps')->where('app_id', $app_id)->get(); 
            }
            else {
                $libraries = [];
            }

            //servers
            $servers = Servers::with('serverapps')->orderBy('server_name','ASC')->get();

            //servers
            foreach($servers as $server)
            {
                $servercount = ServerApp::with('servers')->where('app_id',$app_id)->where('server_id',$server->server_id)->count();
                if($servercount ==1)
                {
                    $server->selected_server = $server->server_id;
                }
                else 
                {
                    $server->selected_server = 0;
                }
            } 

            //persons
            $persons = Person::orderBy('person_name','ASC')->get();

            //persons
            foreach($persons as $person)
            {
                $ownercount = App_Owner::with('persons')->where('app_id',$app_id)->where('app_owner_id',$person->person_id)->count();
                if($ownercount ==1)
                {
                    $person->owner = $person->person_id;
                }
                else 
                {
                    $person->owner = 0;
                }
                $fadmincount = App_FunctionalAdmin::with('persons')->where('app_id',$app_id)->where('app_functionaladmin_id',$person->person_id)->count();
                if($fadmincount ==1)
                {
                    $person->fadmin = $person->person_id;
                }
                else 
                {
                    $person->owner = 0;
                }
                $tadmincount = App_TechAdmin::with('persons')->where('app_id',$app_id)->where('app_techadmin_id',$person->person_id)->count();
                if($tadmincount ==1)
                {
                    $person->tadmin = $person->person_id;
                }
                else 
                {
                    $person->tadmin = 0;
                }
                $tadmincount = Supplier::with('persons')->where('app_id',$app_id)->where('app_supplier_id',$person->person_id)->count();
                if($tadmincount ==1)
                {
                    $person->supplier = $person->person_id;
                }
                else 
                {
                    $person->supplier = 0;
                }

            } 

            //dependent apps
            $dependentcount = App_Dependency::where('app_id',$app_id)->orWhere('dependent_app_id',$app_id)->count();
            if ($dependentcount >=1){
                $dependent = App_Dependency::with('apps','dependent_apps')->where('app_id',$app_id)->orWhere('dependent_app_id',$app_id)->count();
            }
            else {
                $dependent =[];
            }

        
            //return view
            return view('apps.edit', compact('apps','appownercount','apptechadmincount','appfunctionaladmincount','appsuppliercount','appstatus','appowner','apptechadmin','appfunctionaladmin','appsupplier','databasedependency','frameworkdependency','languagedependency','librarycount','libraries','servers','persons','dependentcount','dependent'));       
        }
        
        //apps list
        public function index(Request $request)
        {       
            $sorttype = $request->query('sort');

            if ($sorttype =="app_name"){

                $apps = Apps::with('apps_status','appowners_count','apptechadmins_count','appfunctionaladmins_count','apps_language','apps_framework','apps_database')->orderBy($sorttype,'ASC')->paginate(25);
                $links = $apps->appends(['sortby' => $sorttype])->links();
            }
            elseif ($sorttype =="app_status"){
                $apps = Apps::with('apps_status','appowners_count','apptechadmins_count','appfunctionaladmins_count','apps_language','apps_framework','apps_database')->orderBy($sorttype,'ASC')->paginate(25);
                $links = $apps->appends(['sortby' => $sorttype])->links();
            }
            elseif ($sorttype =="language_dependency"){
                $apps = Apps::with('apps_status','appowners_count','apptechadmins_count','appfunctionaladmins_count','apps_language','apps_framework','apps_database')->orderBy($sorttype,'ASC')->paginate(25);
                $links = $apps->appends(['sortby' => $sorttype])->links();
            }
            elseif ($sorttype =="framework_dependency"){
                $apps = Apps::with('apps_status','appowners_count','apptechadmins_count','appfunctionaladmins_count','apps_language','apps_framework','apps_database')->orderBy($sorttype,'ASC')->paginate(25);
                $links = $apps->appends(['sortby' => $sorttype])->links();
            }
            elseif ($sorttype =="database_dependency"){
                $apps = Apps::with('apps_status','appowners_count','apptechadmins_count','appfunctionaladmins_count','apps_language','apps_framework','apps_database')->orderBy($sorttype,'ASC')->paginate(25);
                $links = $apps->appends(['sortby' => $sorttype])->links();
            }
            else {
                $apps = Apps::with('apps_status','appowners_count','apptechadmins_count','appfunctionaladmins_count','apps_language','apps_framework','apps_database')->paginate(25);
                $links = '';
            }
            
            
            //return view
            return view('apps.index', compact('apps','sorttype','links'));      
        }

        //show app
        public function show($apps)
        {             
            $apps = Apps::with('apps_status','apps_language','apps_framework','apps_database')->where('app_id', $apps)->firstOrFail(); 
            $app_id = $apps->app_id; 
            //app owner
            $appownercount = $this->countAppOwner($app_id);
            if ($appownercount >=1){
                $appownersum = $this->sumAppOwner($app_id);
                $appownersumfte = round($appownersum / 40,2);
                $appowner = App_Owner::with('apps','persons')->where('app_id', $app_id)->get();
                foreach($appowner as $owners){
                    if($owners->hours == 0){
                        $owners->fte = 0;
                    }
                    else {
                        $owners->fte = round($owners->hours / 40, 2);
                    }
                }
            }
            else {
                $appownersum = 0;
                $appownersumfte = 0;
                $appowner = [];
            }
            //app tech admin
            $apptechadmincount = $this->countAppTechAdmin($app_id);
            if ($apptechadmincount >=1){
                $apptechadminsum = $this->sumAppTechAdmin($app_id);
                $apptechadminsumfte = round($apptechadminsum / 40, 2);
                $apptechadmin = App_TechAdmin::with('apps','persons')->where('app_id', $app_id)->get();
                foreach($apptechadmin as $techadmins){
                    if($techadmins->hours == 0){
                        $techadmins->fte = 0;
                    }
                    else {
                        $techadmins->fte = round($techadmins->hours / 40, 2);
                    }
                }       
            }
            else {
                $apptechadminsum = 0;
                $apptechadminsumfte = 0;
                $apptechadmin = [];
            }
            //app functional admin
            $appfunctionaladmincount = $this->countAppFunctionalAdmin($app_id);
            if ($appfunctionaladmincount >=1){
                $appfunctionaladminsum = $this->sumAppFunctionalAdmin($app_id);
                $appfunctionaladminsumfte = round($appfunctionaladminsum / 40, 2);
                $appfunctionaladmin = App_FunctionalAdmin::with('apps','persons')->where('app_id', $app_id)->get(); 
                foreach($appfunctionaladmin as $functionaladmins){
                    if($functionaladmins->hours == 0){
                        $functionaladmins->fte = 0;
                    }
                    else {
                        $functionaladmins->fte = round($functionaladmins->hours / 40, 2);
                    }
                } 
            }
            else {
                $appfunctionaladminsum = 0; 
                $appfunctionaladminsumfte = 0;
                $appfunctionaladmin = [];
            }
            //app supplier
            $appsuppliercount = $this->countAppSupplier($app_id);
            if ($appsuppliercount >=1){
                $appsupplier = Supplier::with('apps','persons')->where('app_id', $app_id)->get(); 
            }
            else {
                $appsupplier = [];
            }
            //libraries
            $librarycount = $this->countlibrary($app_id);
            if ($librarycount >=1){
                $libraries = Library::with('apps')->where('app_id', $app_id)->get(); 
            }
            else {
                $libraries = [];
            }
            //servers
            $serverappcount = $this->countserverapp($app_id);
            if ($serverappcount >=1){
                $serverapps = ServerApp::with('servers')->where('app_id', $app_id)->get(); 
            }
            else {
                $serverapps = [];
            }

            //dependent apps
            $dependentcount = App_Dependency::where('app_id',$app_id)->orWhere('dependent_app_id',$app_id)->count();
            if ($dependentcount >=1){
                $dependent = App_Dependency::with('apps','dependent_apps')->where('app_id',$app_id)->orWhere('dependent_app_id',$app_id)->count();
            }
            else {
                $dependent =[];
            }

            //return view
            return view('apps.show', compact('apps',
            'appownercount','apptechadmincount','appfunctionaladmincount','appsuppliercount',
            'appownersum','apptechadminsum','appfunctionaladminsum',
            'appownersumfte','apptechadminsumfte','appfunctionaladminsumfte',
            'appowner','apptechadmin','appfunctionaladmin','appsupplier',
            'librarycount','libraries','serverappcount','serverapps','dependentcount','dependent')); 
        }

        //delete app function
        public function destroy($id)
        {
            //delete privacy
            $privacy = Privacy::findOrFail($id);
            $privacy->delete();
            //delete app
            $apps = Apps::findOrFail($id);
            $apps->delete();
            //return
            return redirect('/apps')->with('message', 'Succesvol verwijderd');
        }

        //count app servers
        private function countlibrary($app_id)
        {
            $serverappcount = Library::where('app_id', $app_id)->count();
            return $serverappcount;
        }

        //count app servers
        private function countserverapp($app_id)
        {
            $serverappcount = ServerApp::where('app_id', $app_id)->count();
            return $serverappcount;
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

        //count suppliers
        private function countAppSupplier($app_id)
        {
            $appsuppliercount = Supplier::where('app_id', $app_id)->count();
            return $appsuppliercount;
        }

        private function mailer($app_id)
        {
            $apps = Apps::findOrFail($app_id);
            $app_name = $apps->app_name;
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
                            Mail::to($person_mail)->send(new AppNotifyMail($app_name,$person_mail));
                        }
                        
                    }
                }
            }           
            
        }

    //sum app owners
    private function sumAppOwner($app_id)
    {
        $appowner = App_Owner::select('app_id', DB::raw('SUM(hours) as sum_hours'))
        ->where('app_id', $app_id)->groupBy('app_id')
        ->get('sum_hours');
        $appownersum = $appowner[0];
        return $appownersum->sum_hours;
    }

    //sum tech admins
    private function sumAppTechAdmin($app_id)
    {
        $apptechadmin = App_Techadmin::select('app_id', DB::raw('SUM(hours) as sum_hours'))
        ->where('app_id', $app_id)->groupBy('app_id')
        ->get('sum_hours');
        $apptechadminsum = $apptechadmin[0];
        return $apptechadminsum->sum_hours;
    }

    //sum functional admins
    private function sumAppFunctionalAdmin($app_id)
    {
        $appfunctionaladmin = App_Functionaladmin::select('app_id', DB::raw('SUM(hours) as sum_hours'))
        ->where('app_id', $app_id)->groupBy('app_id')
        ->get('sum_hours');
        $appfunctionaladminsum = $appfunctionaladmin[0];
        return $appfunctionaladminsum->sum_hours;
    }       

}