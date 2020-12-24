<?php

namespace App\Http\Controllers;
use App\App_TechAdmin;
use App\Apps;
use App\Person;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class AppTechAdminController extends Controller
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
            'app_techadmin_id' => 'required',
            'app_id' => 'required',
            'hours' => 'nullable'
        ]);  
        $apptechadmin = new App_TechAdmin();  
        $apptechadmin->app_techadmin_id = request('app_techadmin_id');
        $apptechadmin->app_id = request('app_id');
        $apptechadmin->save();          
        //return
        return redirect('/apptechadmin')->with('message', 'Succesvol ingevoerd');            
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

        $apptechadmin = new App_TechAdmin();
        $apps = Apps::orderBy('app_name')->get();
        $person = Person::orderBy('person_name')->get(); 
        return view('apptechadmin.create', compact('apptechadmin','apps','person','new_app','new_person'));        
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'app_techadmin_id' => 'required',
            'app_id' => 'required',
            'hours' => 'nullable'      
        ]);
        App_TechAdmin::where('id',$id)->update($data);
        return redirect('/apptechadmin')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($app_techadmin_id)
    {      
        $new_app = 0;  
        $new_person = 0; 
        
        $apptechadmin = App_TechAdmin::where('id', $app_techadmin_id)->firstOrFail(); 
        $apps = Apps::orderBy('app_name')->get();
        $person = Person::orderBy('person_name')->get();        
        return view('apptechadmin.edit', compact('apptechadmin','apps','person','new_app','new_person'));       
    }
    
    //apps list
    public function index()
    {       
        $apptechadmin = App_TechAdmin::with('apps','persons')->paginate(25);
        $apps = Apps::all();
        $person = Person::all(); 
        return view('apptechadmin.index', ['apptechadmin' =>$apptechadmin,]);        
    }
    
    //show app
    public function show($id)
    {             
        $apptechadmin = App_TechAdmin::where('id', $id)->firstOrFail();
        $app_techadmin_id = $apptechadmin->app_techadmin_id;
        $app_id = $apptechadmin->app_id;
        $person = Person::where('person_id', $app_techadmin_id)->firstOrFail(); 
        $apps = Apps::where('app_id', $app_id)->firstOrFail();          
        return view('apptechadmin.show', compact('apptechadmin','person','apps')); 
    }

    //delete app function
    public function destroy($id)
    {
        $apptechadmin = App_TechAdmin::findOrFail($id);
        $apptechadmin->delete();
        return redirect('/apptechadmin')->with('message', 'Succesvol verwijderd');
    }
}
