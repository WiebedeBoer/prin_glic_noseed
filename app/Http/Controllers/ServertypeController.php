<?php

namespace App\Http\Controllers;
use App\Servertype;
use Illuminate\Http\Request;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class ServertypeController extends Controller
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
            'server_type' => 'required|min:2'
        ]);            
        $servertype = new Servertype();  
        $servertype->server_type = request('server_type');
        $servertype->save();         
        //return
        return redirect('/servertype')->with('message', 'Succesvol ingevoerd');            
    }

    //create view
    public function create()
    {      
        $servertype = new Servertype();
        return view('servertype.create', compact('servertype'));        
    }

    //update function
    public function update(Request $request, $server_type_id)
    {
        $data = $request->validate([
            'server_type' => 'required|min:2'      
        ]);
        Servertype::where('server_type_id',$server_type_id)->update($data);
        return redirect('/servertype')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($server_type_id)
    {      
        $servertype = Servertype::where('server_type_id', $server_type_id)->firstOrFail();        
        return view('servertype.edit', compact('servertype'));       
    }
    
    //server type list
    public function index()
    {       
        $servertype = DB::table('server_type')->paginate(25);
        return view('servertype.index', ['servertype' =>$servertype,]);        
    }
    
    //show server type
    public function show($server_type_id)
    {             
        $servertype = Servertype::where('server_type_id', $server_type_id)->firstOrFail();        
        return view('servertype.show', compact('servertype')); 
    }

    //delete server type function
    public function destroy($id)
    {
        $servertype = Servertype::findOrFail($id);
        $servertype->delete();
        return redirect('/servertype')->with('message', 'Succesvol verwijderd');
    }
}
