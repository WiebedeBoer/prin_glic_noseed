<?php

namespace App\Http\Controllers;
use App\User;
use App\Apps;
use App\App_Status;
use App\Estimate;
use App\ServerApp;
use App\RoadmapTask;
use App\RoadmapTypes;
use App\Roadmap;
use App\RoadmapPerson;
use App\PersonTask;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RoadmapController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //roadmap list
    public function index()
    {       
        $roadmaps = Roadmap::with('apps','servers')->paginate(25);
        return view('roadmaps.index', ['roadmaps' =>$roadmaps,]);        
    }

    //create view
    public function create()
    {      
        $roadmap = new Roadmap();
        $appserver = ServerApp::with('apps','servers')->get();
        $estimates = Estimate::all();
        //return
        return view('roadmaps.create', compact('roadmap','appserver','estimates'));        
    }

    //store function
    public function store()
    {     
        $data = request()->validate([
            'server_app_id' => 'required',
            'estimate_id' => 'required',
            'status' => 'required',
            'milestone_date' => 'required|date',
            'roadmap_release_date' => 'required|date',
            'roadmap_update' => 'required',
            'roadmap_release' => 'required',
            'wishes' => 'required',
            'trello_board' => 'nullable'
        ]);        
        $roadmap = new Roadmap();       
        $roadmap->server_app_id = request('server_app_id');
        $roadmap->estimate_id = request('estimate_id');
        $roadmap->status = request('status');
        $roadmap->milestone_date = request('milestone_date');
        $roadmap->roadmap_release_date = request('roadmap_release_date');
        $roadmap->roadmap_update = request('roadmap_update');
        $roadmap->roadmap_release = request('roadmap_release');
        $roadmap->wishes = request('wishes');
        $roadmap->trello_board = request('trello_board');
        $roadmap->save(); 
        //return
        return redirect('/roadmaps')->with('message', 'Succesvol toegevoegd');
    }

    //edit view
    public function edit($id)
    {      
        $roadmap = Roadmap::where('roadmap_id', $id)->firstOrFail(); 
        $appserver= ServerApp::with('apps','servers')->get();
        $estimates = Estimate::all();
        //return  
        return view('roadmaps.edit', compact('roadmap','appserver','estimates'));       
    } 

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'server_app_id' => 'required',
            'estimate_id' => 'required',
            'status' => 'required',
            'milestone_date' => 'required|date',
            'roadmap_release_date' => 'required|date',
            'roadmap_update' => 'required',
            'roadmap_release' => 'required',
            'wishes' => 'required',
            'trello_board' => 'nullable'        
        ]);
        Roadmap::where('roadmap_id', $id)->update($data);
        //return
        return redirect('/roadmaps')->with('message', 'Succesvol gewijzigd');
    }

    //delete function
    public function destroy($id)
    {
        $roadmap = Roadmap::findOrFail($id);
        $roadmap->delete();
        //return    
        return redirect('/roadmaps')->with('message', 'Succesvol verwijderd');
    }

    //show view
    public function show($id)
    {             
        $roadmap = Roadmap::with('apps','servers','estimates')->where('roadmap_id', $id)->firstOrFail();
        $roadmaptypes = RoadmapTypes::with('apps','servers','estimates','persons')->where('roadmap_id', $id)->get();
        $roadmappersons = RoadmapPerson::with('apps','personnel','types')->where('roadmap_id', $id)->get();

        //person tasks
        $roadmappersontasks = PersonTask::with('roadmaps','persons')->where('roadmap_id', $id)->get();

        //timing and duration
        $starttime = PersonTask::where('roadmap_id', $id)->orderBy('start_time', 'asc')->first();
        $endtime = PersonTask::where('roadmap_id', $id)->orderBy('end_time', 'desc')->first();
        $starttimer = $starttime->start_time;
        $endtimer = $endtime->end_time;
        $duration = $endtimer - $starttimer;
        $durationpart = floor($duration);
        //collect the tasks per person
        foreach($roadmappersons as $roadmapperson)
        {
            $roadmap_person_id = $roadmapperson->id;
            $persontasks = PersonTask::with('roadmaps','persons')->where('roadmap_person_id', $roadmap_person_id)->get();
            //$roadmappersons->put('tasks', $persontasks);
            $roadmapperson->tasks = $persontasks;
            foreach($persontasks as $persontask) 
            {
                $persontask_x = floor(($persontask->start_time - $starttimer) / 1000);
                //$persontask->put('xpos', $persontask_x);
                $persontask->xpos = $persontask_x;
                $persontask_w = floor(($persontask->end_time - $persontask->start_time) / 1000);
                //$persontask->put('xwidth', $persontask_w);
                $persontask->xwidth = $persontask_w;
            }
        }

        //return
        return view('roadmaps.show', compact('roadmap','roadmaptypes','roadmappersons','starttime','endtime','duration')); 
    }


}
