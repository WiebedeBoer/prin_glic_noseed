<?php

namespace App\Http\Controllers;
use App\Serverotap;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServerotapController extends Controller
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
            'server_otap' => 'required|min:2'
        ]);      
        $serverotap = new Serverotap();  
        $serverotap->server_otap = request('server_otap');
        $serverotap->save();        
        //return
        return redirect('/serverotap')->with('message', 'Succesvol ingevoerd');         
    }

    //create view
    public function create()
    {      
        $serverotap = new Serverotap();
        return view('serverotap.create', compact('serverotap'));        
    }

    //update function
    public function update(Request $request, $server_otap_id)
    {
        $data = $request->validate([
            'server_otap' => 'required|min:2'      
        ]);
        Serverotap::where('server_otap_id',$server_otap_id)->update($data);
        return redirect('/serverotap')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($server_otap_id)
    {      
        $serverotap = Serverotap::where('server_otap_id', $server_otap_id)->firstOrFail();        
        return view('serverotap.edit', compact('serverotap'));       
    }
    
    //server otaps list
    public function index()
    {       
        $serverotap = DB::table('server_otap')->paginate(25);
        return view('serverotap.index', ['serverotap' =>$serverotap,]);        
    }
    
    //show server otap
    public function show($server_otap_id)
    {             
        $serverotap = Serverotap::where('server_otap_id', $server_otap_id)->firstOrFail();        
        return view('serverotap.show', compact('serverotap')); 
    }

    //delete server otap function
    public function destroy($id)
    {
        $serverotap = Serverotap::findOrFail($id);
        $serverotap->delete();
        return redirect('/serverotap')->with('message', 'Succesvol verwijderd');
    }
}
