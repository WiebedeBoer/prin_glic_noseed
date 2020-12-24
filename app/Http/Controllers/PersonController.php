<?php

namespace App\Http\Controllers;
use App\Person;
use App\Apps;
use App\App_Owner;
use App\App_TechAdmin;
use App\App_FunctionalAdmin;
use App\Supplier;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class PersonController extends Controller
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
            'person_name' => 'required|min:2',
            'person_email' => 'required|email',
            'person_staff_number' => 'required'
        ]);        
        $persons = new Person();       
        $persons->person_name = request('person_name');
        $persons->person_email = request('person_email');
        $persons->person_staff_number = request('person_staff_number');
        $persons->save();          
        //return
        return redirect('/persons')->with('message', 'Succesvol ingevoerd');       
    }

    //create view
    public function create()
    {      
        $persons = new Person();
        return view('persons.create', compact('persons'));        
    }

    //update function
    public function update(Request $request, $person_id)
    {
        $data = $request->validate([
            'person_name' => 'required|min:2',
            'person_email' => 'required|email',
            'person_staff_number' => 'required'       
        ]);
        Person::where('person_id',$person_id)->update($data);
        return redirect('/persons')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($person_id)
    {      
        $persons = Person::where('person_id', $person_id)->firstOrFail(); 
        $person = $persons->person_id;
        //app owner
        $appownercount = $this->countAppOwner($person);
        if ($appownercount >=1){
            $appownersum = $this->sumAppOwner($person);
            $appownersumfte = round($appownersum / 40,2);
            $appowner = App_Owner::with('apps','persons')->where('app_owner_id', $person)->firstOrFail();
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
        $apptechadmincount = $this->countAppTechAdmin($person);
        if ($apptechadmincount >=1){
            $apptechadminsum = $this->sumAppTechAdmin($person);
            $apptechadminsumfte = round($apptechadminsum / 40, 2);
            $apptechadmin = App_TechAdmin::with('apps','persons')->where('app_techadmin_id', $person)->get();
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
        $appfunctionaladmincount = $this->countAppFunctionalAdmin($person);
        if ($appfunctionaladmincount >=1){
            $appfunctionaladminsum = $this->sumAppFunctionalAdmin($person);
            $appfunctionaladminsumfte = round($appfunctionaladminsum / 40, 2);
            $appfunctionaladmin = App_FunctionalAdmin::with('apps','persons')->where('app_functionaladmin_id', $person)->get();  
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
        $appsuppliercount = $this->countAppSupplier($person);
        if ($appsuppliercount >=1){
            $appsupplier = Supplier::with('apps','persons')->where('app_supplier_id', $person)->get(); 
        }
        else {
            $appsupplier = [];
        }
        //return view 
        return view('persons.edit', compact('persons',
        'appownercount','apptechadmincount','appfunctionaladmincount','appsuppliercount',
        'appownersum','apptechadminsum','appfunctionaladminsum',
        'appownersumfte','apptechadminsumfte','appfunctionaladminsumfte',
        'appowner','apptechadmin','appfunctionaladmin','appsupplier')); 
   }

    //persons list
    public function index(Request $request)
    {       
        $sorttype = $request->query('sort');
        if ($sorttype =="person_name"){
            $persons = Person::with('appowners_count','apptechadmins_count','appfunctionaladmins_count','appsuppliers_count')->orderBy($sorttype,'ASC')->paginate(25);
            $links = $persons->appends(['sortby' => $sorttype])->links();
        }
        else {
            $persons = Person::with('appowners_count','apptechadmins_count','appfunctionaladmins_count','appsuppliers_count')->paginate(25);
            $links = '';
        }      
        
        return view('persons.index', compact('persons','links'));        
    }

    //show person
    public function show($person_id)
    {             
        $persons = Person::where('person_id', $person_id)->firstOrFail();
        $person = $persons->person_id;
        //app owner
        $appownercount = $this->countAppOwner($person);
        if ($appownercount >=1){
            $appownersum = $this->sumAppOwner($person);
            $appownersumfte = round($appownersum / 40,2);
            $appowner = App_Owner::with('apps','persons')->where('app_owner_id', $person)->get();
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
        $apptechadmincount = $this->countAppTechAdmin($person);
        if ($apptechadmincount >=1){
            $apptechadminsum = $this->sumAppTechAdmin($person);
            $apptechadminsumfte = round($apptechadminsum / 40, 2);
            $apptechadmin = App_TechAdmin::with('apps','persons')->where('app_techadmin_id', $person)->get();
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
        $appfunctionaladmincount = $this->countAppFunctionalAdmin($person);
        if ($appfunctionaladmincount >=1){
            $appfunctionaladminsum = $this->sumAppFunctionalAdmin($person);
            $appfunctionaladminsumfte = round($appfunctionaladminsum / 40, 2);
            $appfunctionaladmin = App_FunctionalAdmin::with('apps','persons')->where('app_functionaladmin_id', $person)->get();  
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
        $appsuppliercount = $this->countAppSupplier($person);
        if ($appsuppliercount >=1){
            $appsupplier = Supplier::with('apps','persons')->where('app_supplier_id', $person)->get(); 
        }
        else {
            $appsupplier = [];
        }
        //return view 
        return view('persons.show', compact('persons',
        'appownercount','apptechadmincount','appfunctionaladmincount','appsuppliercount',
        'appownersum','apptechadminsum','appfunctionaladminsum',
        'appownersumfte','apptechadminsumfte','appfunctionaladminsumfte',
        'appowner','apptechadmin','appfunctionaladmin','appsupplier')); 
    }

    //delete person function
    public function destroy($id)
    {
        $persons = Person::findOrFail($id);
        $persons->delete();
        return redirect('/persons')->with('message', 'Succesvol verwijderd');
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

    //show
    public function showAppOwner($app_owner_id)
    {
        $appowner = App_Owner::where('app_owner_id', $app_owner_id)->firstOrFail();
        return $appowner;
    }

    public function showAppTechAdmin($app_techadmin_id)
    {
        $apptechadmin = App_TechAdmin::where('app_techadmin_id', $app_techadmin_id)->firstOrFail();
        return $apptechadmin;
    }

    public function showAppFunctionalAdmin($app_functionaladmin_id)
    {
        $appfunctionaladmin = App_FunctionalAdmin::where('app_functionaladmin_id', $app_functionaladmin_id)->firstOrFail();   
        return $appfunctionaladmin;
    }

    public function showAppSupplier($app_supplier_id)
    {
        $appsupplier = Supplier::where('app_supplier_id', $app_supplier_id)->firstOrFail();   
        return $appsupplier;
    }

}