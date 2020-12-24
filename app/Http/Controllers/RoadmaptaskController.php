<?php

namespace App\Http\Controllers;
use App\ServerApp;
use App\RoadmapTask;
use App\RoadmapTypes;
use App\Roadmap;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class RoadmaptaskController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //roadmap task list
    public function index()
    {       
        $roadmaptasks = RoadmapTask::with('roadmap_types')->paginate(25);
        return view('roadmaptasks.index', ['roadmaptasks' =>$roadmaptasks,]);        
    }

    //store function
    public function store()
    {     
        $data = request()->validate([
            'roadmap_task' => 'required'
        ]);        
        $roadmaptask = new RoadmapTask();       
        $roadmaptask->roadmap_task = request('roadmap_task');
        $roadmaptask->save(); 
        //return
        return redirect('/roadmaptasks')->with('message', 'Succesvol toegevoegd');
    }

    //create view
    public function create()
    {      
        $roadmaptask = new RoadmapTask();
        //return
        return view('roadmaptasks.create', compact('roadmaptask'));        
    }

    //delete function
    public function destroy($id)
    {
        $roadmaptask = RoadmapTask::findOrFail($id);
        $roadmaptask->delete();
        //return    
        return redirect('/roadmaptasks')->with('message', 'Succesvol verwijderd');
    }

    //show view
    public function show($id)
    {             
        $roadmaptask = RoadmapTask::where('task_id', $id)->firstOrFail();
        //return
        return view('roadmaptasks.show', compact('roadmaptask')); 
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'roadmap_task' => 'required'         
        ]);
        RoadmapTask::where('task_id', $id)->update($data);
        //return
        return redirect('/roadmaptasks')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($id)
    {      
        $roadmaptask = RoadmapTask::where('task_id', $id)->firstOrFail(); 
        //return  
        return view('roadmaptasks.edit', compact('roadmaptask'));       
    }  


}
