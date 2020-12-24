<?php

namespace App\Http\Controllers;

use App\Apps;
use App\App_Status;
use App\Estimate;
use App\ServerApp;
use App\Roadmap;
use App\Person;
use App\App_Owner;
use App\App_TechAdmin;
use App\App_FunctionalAdmin;
use App\Supplier;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HourController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //hours list
    public function index()
    {       
        $estimates = Estimate::with('servers_apps','roadmaps','apps','servers')->where('status', 1)->paginate(25);      
        foreach($estimates as $estimate) 
        {
            $id = $estimate->server_app_id;
            $serverapp = ServerApp::with('servers')->where('id', $id)->firstOrFail();
            $estimate->app_name = $serverapp->apps->app_name;
            $estimate->server_name = $serverapp->servers->server_name;
        }
        //return view
        return view('hours.index', compact('estimates'));      
    }

    //archive list
    public function archive()
    {       
        $estimates = Estimate::with('servers_apps','roadmaps','apps','servers')->where('status', 0)->paginate(25);
        foreach($estimates as $estimate) 
        {
            $id = $estimate->server_app_id;
            $serverapp = ServerApp::with('servers')->where('id', $id)->firstOrFail();
            $estimate->app_name = $serverapp->apps->app_name;
            $estimate->server_name = $serverapp->servers->server_name;
        }
        //return view
        return view('hours.archive', compact('estimates'));      
    }

    //create view
    public function create()
    {      
        $estimate = new Estimate();
        $roadmap = new Roadmap();
        $appserver = ServerApp::with('apps','servers')->get();  
        return view('hours.create', compact('estimate','roadmap','appserver'));        
    }

    //update function
    public function update(Request $request, $estimate_id)
    {
        $data = $request->validate([
            'server_app_id' => 'required', 
            'hour_estimate' => 'required', 
            'hour_update' => 'nullable', 
            'trello_board' => 'nullable',
            'status' => 'required',  
            'roadmap_id' => 'required'              
        ]);
        Estimate::where('estimate_id',$estimate_id)->update($data);
        return redirect('/hours')->with('message', 'Succesvol gewijzigd');
    }

    //store function
    public function store()
    {          
        $data = request()->validate([            
            'server_app_id' => 'required', 
            'status' => 'required',  
            'hour_estimate' => 'required', 
            'hour_update' => 'nullable',  
            'trello_board' => 'nullable'  
        ]);          
        $estimate = new Estimate();  
        $estimate->server_app_id = request('server_app_id');
        $estimate->save(); 
        //roadmap create
        $this->startroadmap();
        //return
        return redirect('/hours')->with('message', 'Succesvol ingevoerd inclusief roadmap');          
    } 

    //edit view
    public function edit($estimate_id)
    {      
        $estimate = Estimate::with('servers_apps','roadmaps','apps')->where('estimate_id', $estimate_id)->firstOrFail();
        $server_app_id = $estimate->server_app_id;
        $server_apps = ServerApp::with('apps','servers')->where('id', $server_app_id)->first();  
        $appserver = ServerApp::with('apps','servers')->get();    
        return view('hours.edit', compact('estimate','server_apps','appserver'));       
    }

    //show view
    public function show($estimate_id)
    {             
        $estimate = Estimate::with('servers_apps','roadmaps')->where('estimate_id', $estimate_id)->firstOrFail();        
        $server_app_id = $estimate->server_app_id;
        $server_apps = ServerApp::with('apps','servers')->where('id', $server_app_id)->first(); 
        return view('hours.show', compact('estimate','server_apps')); 
    }

    //delete function
    public function destroy($id)
    {
        $estimate = Estimate::findOrFail($id);
        $roadmap_id = $estimate->roadmap_id;
        $roadmap = Roadmap::findOrFail($roadmap_id);
        $estimate->delete();
        $roadmap->delete();
        return redirect('/hours')->with('message', 'Succesvol verwijderd inclusief roadmap');
    } 

    //persons list
    public function person(Request $request)
    {       
        $sorttype = $request->query('sort');
        if ($sorttype =="person_name"){
            $persons = Person::with('appowners_count','apptechadmins_count','appfunctionaladmins_count','appsuppliers_count')->orderBy($sorttype,'ASC')->paginate(25);
            //links
            $links = $persons->appends(['sortby' => $sorttype])->links();
        }
        else {
            $persons = Person::with('appowners_count','apptechadmins_count','appfunctionaladmins_count','appsuppliers_count')->paginate(25);         
            //links
            $links = '';
        } 
        
        //adding fte
        foreach($persons as $person)
        {

            //app owner
            $appownercount = $this->countAppOwner($person->person_id);
            if ($appownercount >=1){
                $person->appownersum = $this->sumAppOwner($person->person_id);
                $person->appownersumfte = round($person->appownersum / 40,2);
            }
            else {
                $person->appownersum = 0;
                $person->appownersumfte = 0;
            }
            //app tech admin
            $apptechadmincount = $this->countAppTechAdmin($person->person_id);
            if ($apptechadmincount >=1){
                $person->apptechadminsum = $this->sumAppTechAdmin($person->person_id);
                $person->apptechadminsumfte = round($person->apptechadminsum / 40, 2);
            }
            else {
                $person->apptechadminsum = 0;
                $person->apptechadminsumfte = 0;
            }
            //app functional admin
            $appfunctionaladmincount = $this->countAppFunctionalAdmin($person->person_id);
            if ($appfunctionaladmincount >=1){
                $person->appfunctionaladminsum = $this->sumAppFunctionalAdmin($person->person_id);
                $person->appfunctionaladminsumfte = round($person->appfunctionaladminsum / 40, 2); 
            }
            else {
                $person->appfunctionaladminsum = 0;
                $person->appfunctionaladminsumfte = 0;
            }

        }

        $totalappowner = $this->totalAppOwner();
        $totalapptechadmin = $this->totalAppTechAdmin();
        $totalappfunctionaladmin = $this->totalAppFunctionalAdmin();

        if($totalappowner >0){
            $totalappownerfte = round($totalappowner / 40, 2);
        }
        else {
            $totalappownerfte = 0;
        }
        if($totalapptechadmin >0){
            $totalapptechadminfte = round($totalapptechadmin / 40,2);
        }
        else {
            $totalapptechadminfte = 0;
        }
        if($totalappfunctionaladmin >0){
            $totalappfunctionaladminfte = round($totalappfunctionaladmin / 40, 2);
        }
        else {
            $totalappfunctionaladminfte = 0;
        }
        
        return view('hours.person', compact('persons','links',
        'totalappowner','totalapptechadmin','totalappfunctionaladmin',
        'totalappownerfte','totalapptechadminfte','totalappfunctionaladminfte'));        
    }
    
    //count functional admins
    private function countFunctionalAdmin($app_id)
    {
        $appfunctionaladmincount = App_FunctionalAdmin::where('app_id', $app_id)->count();
        if ($appfunctionaladmincount >=1){
            $appfunctionaladmin = App_FunctionalAdmin::with('persons')->where('app_id', $app_id)->firstOrFail();  
        }
        else {
            $appfunctionaladmin = false;
        } 
        return $appfunctionaladmin;
    } 

    public function startroadmap()
    {
        //get max estimate
        $nestimate = DB::table('estimates')->max('estimate_id');
        $estimate_id = $nestimate->estimate_id;
        $server_app_id = $nestimate->server_app_id;
        //save roadmap
        $roadmap = new Roadmap(); 
        $roadmap->estimate_id = $estimate_id;
        $roadmap->save();
        //get max roadmap
        $nroadmap = DB::table('roadmaps')->max('roadmap_id');
        $roadmap_id = $nroadmap->roadmap_id;
        //app
        $app = ServerApp::where('id', $server_app_id)->firstOrFail();
        $app_id = $app->app_id;
        //roadmap persons
        $this->addroadmapperson($app_id,$server_app_id,$roadmap_id);
        //update estimate with roadmap
        Estimate::where('id', $estimate_id)->update(['roadmap_id' => roadmap_id]);
    }

    //auto add roadmap persons
    public function addroadmapperson($app_id,$server_app_id,$roadmap_id)
    {
        //get the admins
        $appfunctionaladmin = $this->countFunctionalAdmin($app_id);
        if($appfunctionaladmin !=false)
        {
            //auto insert
            foreach($appfunctionaladmin as $app_functionaladmin)
            {
               $app_functionaladmin_id = $app_functionaladmin->app_functionaladmin_id;
               $roadmapperson = new RoadmapPerson(); 
               $roadmapperson->person_id = $app_functionaladmin_id;
               $roadmapperson->serverapp_id = $server_app_id;
               $roadmapperson->roadmap_id = $roadmap_id;
               $roadmapperson->save();
            } 
        }            

    } 

    //count app owners
    private function countAppOwner($app_owner_id)
    {
        $appownercount = App_Owner::where('app_owner_id', $app_owner_id)->count();
        return $appownercount;
    }

    //count tech admins
    private function countAppTechAdmin($app_techadmin_id)
    {
        $apptechadmincount = App_TechAdmin::where('app_techadmin_id', $app_techadmin_id)->count();
        return $apptechadmincount;
    }

    //count functional admins
    private function countAppFunctionalAdmin($app_functionaladmin_id)
    {
        $appfunctionaladmincount = App_FunctionalAdmin::where('app_functionaladmin_id', $app_functionaladmin_id)->count();
        return $appfunctionaladmincount;
    }

    //count functional admins
    private function countAppSupplier($app_supplier_id)
    {
        $appsuppliercount = Supplier::where('app_supplier_id', $app_supplier_id)->count();
        return $appsuppliercount;
    }

    //sum app owners
    private function sumAppOwner($app_owner_id)
    {
        $appowner = App_Owner::select('app_owner_id', DB::raw('SUM(hours) as sum_hours'))
        ->where('app_owner_id', $app_owner_id)->groupBy('app_owner_id')
        ->get('sum_hours');
        $appownersum = $appowner[0];
        return $appownersum->sum_hours;
    }

    //sum tech admins
    private function sumAppTechAdmin($app_techadmin_id)
    {
        $apptechadmin = App_Techadmin::select('app_techadmin_id', DB::raw('SUM(hours) as sum_hours'))
        ->where('app_techadmin_id', $app_techadmin_id)->groupBy('app_techadmin_id')
        ->get('sum_hours');
        $apptechadminsum = $apptechadmin[0];
        return $apptechadminsum->sum_hours;
    }

    //sum functional admins
    private function sumAppFunctionalAdmin($app_functionaladmin_id)
    {
        $appfunctionaladmin = App_Functionaladmin::select('app_functionaladmin_id', DB::raw('SUM(hours) as sum_hours'))
        ->where('app_functionaladmin_id', $app_functionaladmin_id)->groupBy('app_functionaladmin_id')
        ->get('sum_hours');
        $appfunctionaladminsum = $appfunctionaladmin[0];
        return $appfunctionaladminsum->sum_hours;
    }

    //sum functional admins
    private function sumAppSupplier($app_supplier_id)
    {
        $appsupplier = Supplier::select('app_supplier_id', DB::raw('SUM(hours) as sum_hours'))
        ->where('app_supplier_id', $app_supplier_id)->groupBy('app_supplier_id')
        ->get('sum_hours');
        $appsuppliersum = $appsupplier[0];
        return $appsuppliersum->sum_hours;
    }

    //total app owners
    private function totalAppOwner()
    {
        $appowner = DB::table("app_owner")->get()->sum("hours");
        return $appowner;
    }

    //sum tech admins
    private function totalAppTechAdmin()
    {
        $apptechadmin = DB::table("app_techadmin")->get()->sum("hours");
        return $apptechadmin;
    }

    //sum functional admins
    private function totalAppFunctionalAdmin()
    {
        $appfunctionaladmin = DB::table("app_functionaladmin")->get()->sum("hours");
        return $appfunctionaladmin;
    }

}
