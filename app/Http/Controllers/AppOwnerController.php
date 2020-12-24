<?php

namespace App\Http\Controllers;
use App\App_Owner;
use App\Apps;
use App\Person;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class AppOwnerController extends Controller
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
            'app_owner_id' => 'required',
            'app_id' => 'required',
            'hours' => 'nullable'
        ]);  
        $appowner = new App_Owner();  
        $appowner->app_owner_id = request('app_owner_id');
        $appowner->app_id = request('app_id');
        $appowner->save();          
        //return
        return redirect('/appowner')->with('message', 'Succesvol ingevoerd');            
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

        $appowner = new App_Owner();
        $apps = Apps::orderBy('app_name')->get();
        $persons = Person::orderBy('person_name')->get();  
        return view('appowner.create', compact('appowner','apps','persons','new_app','new_person'));        
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'app_owner_id' => 'required',
            'app_id' => 'required',
            'hours' => 'nullable'      
        ]);
        App_Owner::where('id',$id)->update($data);
        return redirect('/appowner')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($appowner)
    {      

        $new_app = 0;  
        $new_person = 0;   
        
        $appowner = App_Owner::where('id', $appowner)->firstOrFail();
        $apps = Apps::orderBy('app_name')->get();
        $persons = Person::orderBy('person_name')->get();          
        return view('appowner.edit', compact('appowner','apps','persons','new_app','new_person'));       
    }
    
    //apps list
    public function index()
    {       
        $appowner = App_Owner::with('apps','persons')->paginate(25);
        $apps = Apps::all();
        $persons = Person::all(); 
        return view('appowner.index', ['appowner' =>$appowner,]);        
    }
    
    //show app owner
    public function show($appowner)
    {             
        $appowner = App_Owner::where('id', $appowner)->firstOrFail(); 
        $app_owner_id = $appowner->app_owner_id;
        $app_id = $appowner->app_id;
        $person = Person::where('person_id', $app_owner_id)->firstOrFail(); 
        $apps = Apps::where('app_id', $app_id)->firstOrFail();     
        return view('appowner.show', compact('appowner','person','apps')); 
    }

    //delete app function
    public function destroy($id)
    {
        $appowner = App_Owner::findOrFail($id);
        $appowner->delete();
        return redirect('/appowner')->with('message', 'Succesvol verwijderd');
    }
}
