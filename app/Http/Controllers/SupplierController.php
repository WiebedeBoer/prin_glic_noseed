<?php

namespace App\Http\Controllers;
use App\Supplier;
use App\Apps;
use App\Person;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
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
            'app_supplier_id' => 'required',
            'app_id' => 'required'
        ]);  
        $appsupplier = new Supplier();  
        $appsupplier->app_supplier_id = request('app_supplier_id');
        $appsupplier->app_id = request('app_id');
        $appsupplier->save();          
        //return
        return redirect('/suppliers')->with('message', 'Succesvol ingevoerd');            
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
        
        $appsupplier = new Supplier();
        $apps = Apps::orderBy('app_name')->get();
        $person = Person::orderBy('person_name')->get();  
        return view('suppliers.create', compact('appsupplier','apps','person','new_app','new_person'));        
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'app_supplier_id' => 'required',
            'app_id' => 'required'      
        ]);
        Supplier::where('id',$id)->update($data);
        return redirect('/suppliers')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($id)
    {      
        $new_app = 0;  
        $new_person = 0;        
        
        $appsupplier = Supplier::where('id', $id)->firstOrFail(); 
        $apps = Apps::orderBy('app_name')->get();
        $person = Person::orderBy('person_name')->get();        
        return view('suppliers.edit', compact('appsupplier','apps','person','new_app','new_person'));       
    }
    
    //apps supplier list
    public function index()
    {       
        $appsupplier = Supplier::with('apps','persons')->paginate(25);
        return view('suppliers.index', ['appsupplier' =>$appsupplier,]);        
    }
    
    //show app supplier
    public function show($id)
    {             
        $appsupplier = Supplier::with('apps','persons')->where('id', $id)->firstOrFail();
        $app_supplier_id = $appsupplier->app_supplier_id;
        $app_id = $appsupplier->app_id;
        $person = Person::where('person_id', $app_supplier_id)->firstOrFail(); 
        $apps = Apps::where('app_id', $app_id)->firstOrFail();          
        return view('suppliers.show', compact('appsupplier','person','apps')); 
    }

    //delete app supplier function
    public function destroy($id)
    {
        $appsupplier = Supplier::findOrFail($id);
        $appsupplier->delete();
        return redirect('/suppliers')->with('message', 'Succesvol verwijderd');
    }
}
