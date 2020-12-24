<?php

namespace App\Http\Controllers;

use App\Apps;
use App\App_Status;
use App\App_Owner;
use App\App_TechAdmin;
use App\App_FunctionalAdmin;
use App\Person;
use App\Privacy;
use App\Supplier;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PrivacyExport;

class PrivacyController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //privacy list
    public function index(Request $request)
    {       
        
        $sorttype = $request->query('sort');

        if ($sorttype =="app_name"){
            $apps = Apps::with('apps_status','apps_database','appsuppliers_count','apps_person_supplier')->orderBy($sorttype,'ASC')->paginate(25);
            $links = $apps->appends(['sortby' => $sorttype])->links();
        }
        elseif ($sorttype =="app_status"){
            $apps = Apps::with('apps_status','apps_database','appsuppliers_count','apps_person_supplier')->orderBy($sorttype,'ASC')->paginate(25);
            $links = $apps->appends(['sortby' => $sorttype])->links();
        }
        elseif ($sorttype =="privacy_status"){
            $apps = Apps::with('apps_status','apps_database','appsuppliers_count','apps_person_supplier')->orderBy($sorttype,'ASC')->paginate(25);
            $links = $apps->appends(['sortby' => $sorttype])->links();
        }
        else {
            $apps = Apps::with('apps_status','apps_database','appsuppliers_count','apps_person_supplier')->paginate(25);
            $links = '';
        }           
 
        return view('privacy.index', compact('apps','links'));        
    }

    //update function
    public function update(Request $request, $privacy_id)
    {
        $data = $request->validate([
            'goals' => 'nullable',
            'involved' => 'nullable',
            'person_data' => 'nullable',
            'terms' => 'nullable',
            'recipients' => 'nullable',
            'extern' => 'nullable',
            'safety_measures' => 'nullable',
            'clients' => 'nullable'      
            ]);
        Privacy::where('privacy_id',$privacy_id)->update($data);
        return redirect('/privacy')->with('message', 'Succesvol gewijzigd');
    }
    
    //edit view
    public function edit($privacy_id)
    {      
        $privacy = Privacy::where('privacy_id', $privacy_id)->firstOrFail();
        $app_id = $privacy->privacy_id;
        $apps = Apps::where('app_id', $privacy_id)->firstOrFail();                
        return view('privacy.edit', compact('privacy','apps'));       
    }

    //show app status
    public function show($privacy_id)
    {             
        $privacy = Privacy::where('privacy_id', $privacy_id)->firstOrFail(); 
        $app_id = $privacy->privacy_id;
        $apps = Apps::where('app_id', $privacy_id)->firstOrFail(); 
        $appsupplier = $this->countAppSupplier($privacy_id);       
        return view('privacy.show', compact('privacy','apps','appsupplier')); 
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
        return redirect('/privacy')->with('message', 'Succesvol verwijderd');
    }

    //print excel
    public function export() 
    {
        return Excel::download(new PrivacyExport, 'privacy.csv');
    }

    //count suppliers
    private function countAppSupplier($app_id)
    {
        $appsuppliercount = Supplier::where('app_id', $app_id)->count();
        if ($appsuppliercount >=1){
            //$appsupplier = Supplier::where('app_id', $app_id)->firstOrFail(); 
             $appsupplier = Supplier::with('persons')->where('app_id', $app_id)->firstOrFail();
        }
        else {
            $appsupplier = false;
        } 
        return $appsupplier;
    }

}
