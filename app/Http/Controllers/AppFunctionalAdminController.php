<?php

namespace App\Http\Controllers;
use App\App_FunctionalAdmin;
use App\Apps;
use App\Person;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class AppFunctionalAdminController extends Controller
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
            'app_functionaladmin_id' => 'required',
            'app_id' => 'required',
            'hours' => 'nullable'
        ]);  
        $appfunctionaladmin = new App_FunctionalAdmin();  
        $appfunctionaladmin->app_functionaladmin_id = request('app_functionaladmin_id');
        $appfunctionaladmin->app_id = request('app_id');
        $appfunctionaladmin->save();          
        //return
        return redirect('/appfunctionaladmin')->with('message', 'Succesvol ingevoerd');            
    }

    //create view
    public function create(Request $request)
    {      
        
        $request_app = $request->query('app');
        if($request_app >=1){
            $new_app = $request_app;
        }
        else{
            $new_app = 0;
        }

        $request_person = $request->query('person');
        if($request_person >=1){
            $new_person = $request_person;
        }
        else{
            $new_person = 0;
        }       
        
        $appfunctionaladmin = new App_FunctionalAdmin();
        $apps = Apps::orderBy('app_name')->get();
        $person = Person::orderBy('person_name')->get();  
        return view('appfunctionaladmin.create', compact('appfunctionaladmin','apps','person','new_app','new_person'));        
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'app_functionaladmin_id' => 'required', 
            'app_id' => 'required',
            'hours' => 'nullable'     
        ]);
        App_FunctionalAdmin::where('id',$id)->update($data);
        return redirect('/appfunctionaladmin')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($app_functionaladmin_id)
    {      
        $new_app = 0;  
        $new_person = 0; 
        
        $appfunctionaladmin = App_FunctionalAdmin::where('id', $app_functionaladmin_id)->firstOrFail();        
        $apps = Apps::orderBy('app_name')->get();
        $person = Person::orderBy('person_name')->get();  
        return view('appfunctionaladmin.edit', compact('appfunctionaladmin','apps','person','new_app','new_person'));       
    }
    
    //apps list
    public function index()
    {       
        $appfunctionaladmin = App_FunctionalAdmin::with('apps','persons')->paginate(25);
        $apps = Apps::all();
        $person = Person::all(); 
        return view('appfunctionaladmin.index', ['appfunctionaladmin' =>$appfunctionaladmin,]);        
    }
    
    //show app
    public function show($id)
    {             
        $appfunctionaladmin = App_FunctionalAdmin::where('id', $id)->firstOrFail(); 
        $app_functionaladmin_id = $appfunctionaladmin->app_functionaladmin_id;
        $app_id = $appfunctionaladmin->app_id;
        $person = Person::where('person_id', $app_functionaladmin_id)->firstOrFail(); 
        $apps = Apps::where('app_id', $app_id)->firstOrFail();        
        return view('appfunctionaladmin.show', compact('appfunctionaladmin','person','apps')); 
    }

    //delete app function
    public function destroy($id)
    {
        $appfunctionaladmin = App_FunctionalAdmin::findOrFail($id);
        $appfunctionaladmin->delete();
        return redirect('/appfunctionaladmin')->with('message', 'Succesvol verwijderd');
    }
}
