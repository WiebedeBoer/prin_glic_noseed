<?php

namespace App\Http\Controllers;
use App\Serverservice;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServerServiceController extends Controller
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
            'server_service' => 'required|min:2',
            'server_service_description' => 'nullable'
        ]);            
        $serverservice = new Serverservice();  
        $serverservice->server_service = request('server_service');
        $serverservice->save();         
        //return
        return redirect('/serverservice')->with('message', 'Succesvol ingevoerd');            
    }

    //create view
    public function create()
    {      
        $serverservice = new Serverservice();
        return view('serverservice.create', compact('serverservice'));        
    }

    //update function
    public function update(Request $request, $server_service_id)
    {
        $data = $request->validate([
            'server_service' => 'required|min:2',
            'server_service_description' => 'nullable'     
        ]);
        Serverservice::where('server_service_id',$server_service_id)->update($data);
        return redirect('/serverservice')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($server_service_id)
    {      
        $serverservice = Serverservice::where('server_service_id', $server_service_id)->firstOrFail();        
        return view('serverservice.edit', compact('serverservice'));       
    }
    
    //server service list
    public function index()
    {       
        $serverservice = DB::table('server_service')->paginate(25);
        return view('serverservice.index', ['serverservice' =>$serverservice,]);        
    }
    
    //show server service
    public function show($server_service_id)
    {             
        $serverservice = Serverservice::where('server_service_id', $server_service_id)->firstOrFail();        
        return view('serverservice.show', compact('serverservice')); 
    }

    //delete server service function
    public function destroy($id)
    {
        $serverservice = Serverservice::findOrFail($id);
        $serverservice->delete();
        return redirect('/serverservice')->with('message', 'Succesvol verwijderd');
    }
}
