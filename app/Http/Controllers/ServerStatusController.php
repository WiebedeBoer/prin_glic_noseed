<?php

namespace App\Http\Controllers;
use App\Serverstatus;
use App\User;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ServerStatusController extends Controller
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
            'server_status' => 'required|min:2'
        ]);            
        $serverstatus = new Serverstatus();  
        $serverstatus->server_status = request('server_status');
        $serverstatus->save();         
        //return
        return redirect('/serverstatus')->with('message', 'Succesvol ingevoerd');            
    }

    //create view
    public function create()
    {      
        $serverstatus = new Serverstatus();
        return view('serverstatus.create', compact('serverstatus'));        
    }

    //update function
    public function update(Request $request, $server_status_id)
    {
        $data = $request->validate([
            'server_status' => 'required|min:2'      
        ]);
        Serverstatus::where('server_status_id',$server_status_id)->update($data);
        return redirect('/serverstatus')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($server_status_id)
    {      
        $serverstatus = Serverstatus::where('server_status_id', $server_status_id)->firstOrFail();        
        return view('serverstatus.edit', compact('serverstatus'));       
    }
    
    //server status list
    public function index()
    {       
        $serverstatus = DB::table('server_status')->paginate(25);
        return view('serverstatus.index', ['serverstatus' =>$serverstatus,]);        
    }
    
    //show server status
    public function show($server_status_id)
    {             
        $serverstatus = Serverstatus::where('server_status_id', $server_status_id)->firstOrFail();        
        return view('serverstatus.show', compact('serverstatus')); 
    }

    //delete server status function
    public function destroy($id)
    {
        $serverstatus = Serverstatus::findOrFail($id);
        $serverstatus->delete();
        return redirect('/serverstatus')->with('message', 'Succesvol verwijderd');
    }

 


}
