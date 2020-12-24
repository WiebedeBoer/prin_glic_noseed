<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Apps;
use App\Database;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class DbController extends Controller
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
            'db_name' => 'required|min:2'
        ]);          
        $database = new Database();  
        $database->db_name = request('db_name');
        $database->save();       
        //return
        return redirect('/databases')->with('message', 'Succesvol ingevoerd');          
    }

    //create view
    public function create()
    {      
        $databases = new Database();
        return view('databases.create', compact('databases'));        
    }

    //update function
    public function update(Request $request, $db_id)
    {
        $data = $request->validate([
            'db_name' => 'required|min:2'      
        ]);
        Database::where('db_id',$db_id)->update($data);
        return redirect('/databases')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($databases)
    {      
        $databases = Database::where('db_id', $databases)->firstOrFail();        
        return view('databases.edit', compact('databases'));       
    }
    
    //app status list
    public function index()
    {       
        $databases = DB::table('databases')->paginate(25);
        return view('databases.index', ['databases' =>$databases,]);        
    }
    
    //show app status
    public function show($databases)
    {             
        $databases = Database::where('db_id', $databases)->firstOrFail();        
        return view('databases.show', compact('databases')); 
    }

    //delete app status function
    public function destroy($id)
    {
        $databases = Database::findOrFail($id);
        $databases->delete();
        return redirect('/databases')->with('message', 'Succesvol verwijderd');
    }
}
