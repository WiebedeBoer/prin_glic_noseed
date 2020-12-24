<?php

namespace App\Http\Controllers;
use App\ServerApp;
use App\RoadmapTask;
use App\RoadmapTypes;
use App\Roadmap;
use App\Person;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoadmaptypeController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //roadmap list
    public function index()
    {       
        $roadmaptypes = RoadmapTypes::with('apps','servers')->paginate(25);
        return view('roadmaptypes.index', ['roadmaptypes' =>$roadmaptypes,]);        
    }

    //delete function
    public function destroy($id)
    {
        $roadmaptypes = RoadmapTypes::findOrFail($id);
        //$roadmaptypes->detach($id);
        $roadmaptypes->delete();
        //return    
        return redirect('/roadmaptypes')->with('message', 'Succesvol verwijderd');
    }

    //show view
    public function show($id)
    {             
        $roadmaptypes = RoadmapTypes::with('apps','servers','roadmap_tasks')->where('id', $id)->firstOrFail();
        $serverapp_id = $roadmaptypes->serverapp_id;

        $serverapps = ServerApp::with('servers','apps','apps_language','apps_framework','apps_database')->where('id', $serverapp_id)->firstOrFail();

        //return
        return view('roadmaptypes.show', compact('roadmaptypes','serverapps')); 
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'roadmap_id' => 'required', 
            'serverapp_id' => 'required', 
            'roadmap_task' => 'required', 
            'roadmap_update' => 'required',
            'start_date' => 'required', 
            'end_date' => 'required'            
        ]);
        RoadmapTypes::where('id', $id)->update($data);
        //return
        return redirect('/roadmaptypes')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($id)
    {      
        $roadmaptypes = RoadmapTypes::with('apps','servers','roadmap_tasks')->where('id', $id)->firstOrFail(); 
        $server_apps = ServerApp::with('servers','apps','apps_language','apps_framework','apps_database')->get();
        $roadmaps = Roadmap::with('apps','servers')->get();
        $roadmap_tasks = RoadmapTask::with('roadmap_types')->get();
        //return  
        return view('roadmaptypes.edit', compact('roadmaptypes','server_apps','roadmaps','roadmap_tasks'));       
    } 
    
    //store function
    public function store()
    {     
        $data = request()->validate([
            'roadmap_id' => 'required', 
            'serverapp_id' => 'required', 
            'roadmap_task' => 'required', 
            'roadmap_update' => 'required',
            'start_date' => 'required', 
            'end_date' => 'required'  
        ]);        
        $roadmaptypes = new RoadmapTypes();       
        $roadmaptypes->roadmap_id = request('roadmap_id');
        $roadmaptypes->serverapp_id = request('serverapp_id');
        $roadmaptypes->roadmap_task = request('roadmap_task');
        $roadmaptypes->roadmap_update = request('roadmap_update');
        $roadmaptypes->start_date = request('start_date');
        $roadmaptypes->end_date = request('end_date');
        $roadmaptypes->save(); 
        //return
        return redirect('/roadmaptypes')->with('message', 'Succesvol toegevoegd');
    }

    //create view
    public function create()
    {      
        $roadmaptypes = new RoadmapTypes();
        $server_apps = ServerApp::with('servers','apps','apps_language','apps_framework','apps_database')->get();
        $roadmaps = Roadmap::with('apps','servers')->get();
        $roadmap_tasks = RoadmapTask::with('roadmap_types')->get();
        //return
        return view('roadmaptypes.create', compact('roadmaptypes','server_apps','roadmaps','roadmap_tasks'));        
    }


}
