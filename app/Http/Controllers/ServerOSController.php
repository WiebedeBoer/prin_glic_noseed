<?php

namespace App\Http\Controllers;
use App\Serveros;
use App\User;
use App\ServerApp;
use App\Servers;
use App\App_FunctionalAdmin;
use App\App_TechAdmin;
use App\App_Owner;
use App\Notificatie;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Mail;

class ServerOSController extends Controller
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
            'server_os_name' => 'required|min:2',
            'code_name' => 'required|min:2',
            'release' => 'required|date',
            'end_of_support' => 'required|date',
            'notification' => 'nullable|date',
            'server_os_description' => 'nullable'
        ]);            
        $serveros = new Serveros();  
        $serveros->server_os_name = request('server_os_name');
        $serveros->code_name = request('code_name');
        $serveros->release = request('release');
        $serveros->end_of_support = request('end_of_support');
        $serveros->server_os_description = request('server_os_description');
        $serveros->save();         
        //return
        return redirect('/serveros')->with('message', 'Succesvol ingevoerd');            
    }

    //create view
    public function create()
    {      
        $serveros = new Serveros();
        return view('serveros.create', compact('serveros'));        
    }

    //update function
    public function update(Request $request, $server_os_id)
    {
        $data = $request->validate([
            'server_os_name' => 'required|min:2',
            'code_name' => 'required|min:2',
            'release' => 'required|date',
            'end_of_support' => 'required|date',
            'notification' => 'nullable|date',
            'server_os_description' => 'nullable'      
        ]);
        Serveros::where('server_os_id',$server_os_id)->update($data);
        return redirect('/serveros')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($server_os_id)
    {      
        $serveros = Serveros::where('server_os_id', $server_os_id)->firstOrFail();        
        return view('serveros.edit', compact('serveros'));       
    }
    
    //server service list
    public function index()
    {       
        $serveros = DB::table('server_os')->paginate(25);
        $ndate = new DateTime('now');
        $ldate = $ndate->format('Y');
        $pdate = $ldate + 1;
        return view('serveros.index', compact('serveros','ldate','pdate'));        
    }
    
    //show server service
    public function show($server_os_id)
    {             
        $serveros = Serveros::where('server_os_id', $server_os_id)->firstOrFail();
        $resultcount = Servers::where('server_operating_system', $server_os_id)->count();
        if($resultcount >=1){
            $results = Servers::with('servers_status','servers_os')->where('server_operating_system', $server_os_id)->get();
        }  
        else {
            $results =[];
        }      
        return view('serveros.show', compact('serveros','resultcount','results')); 
    }

    //delete server service function
    public function destroy($id)
    {
        $serveros = Serveros::findOrFail($id);
        $serveros->delete();
        return redirect('/serveros')->with('message', 'Succesvol verwijderd');
    }

    //
    //
    //moved to cron task




}
