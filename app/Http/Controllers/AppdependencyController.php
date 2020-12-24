<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\App_Dependency;
use App\Apps;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class AppdependencyController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //app dependency list
    public function index()
    {       
        $apps = App_Dependency::with('apps','dependent_apps')->paginate(25);
        return view('appdependencies.index', ['apps' =>$apps,]);        
    }

    //store function
    public function store()
    {          
        $data = request()->validate([            
            'app_id' => 'required',
            'dependent_app_id' => 'required'
        ]);          
        $appdependency = new App_Dependency();  
        $appdependency->app_id = request('app_id');
        $appdependency->dependent_app_id = request('dependent_app_id');
        $appdependency->save();       
        //return
        return redirect('/appdependencies')->with('message', 'Succesvol ingevoerd');          
    }

    //create view
    public function create()
    {      
        $appdependency = new App_Dependency();
        $apps = Apps::with('apps_status','appowners_count','apptechadmins_count','appfunctionaladmins_count','apps_language','apps_framework','apps_database')->get();
        return view('appdependencies.create', compact('apps','appdependency'));        
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'app_id' => 'required',
            'dependent_app_id' => 'required'   
        ]);
        App_Dependency::where('id',$id)->update($data);
        return redirect('/appdependencies')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($id)
    {      
        $appdependency = App_Dependency::where('id', $id)->firstOrFail();
        $apps = Apps::with('apps_status','appowners_count','apptechadmins_count','appfunctionaladmins_count','apps_language','apps_framework','apps_database')->get();        
        return view('appdependencies.edit', compact('apps','appdependency'));       
    }

    //show view
    public function show($id)
    {             
        $apps = App_Dependency::where('id', $id)->firstOrFail();        
        return view('appdependencies.show', compact('apps')); 
    }

    //delete function
    public function destroy($id)
    {
        $appdependency = App_Dependency::findOrFail($id);
        $appdependency->delete();
        return redirect('/appdependencies')->with('message', 'Succesvol verwijderd');
    }


}
