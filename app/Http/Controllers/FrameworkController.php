<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Apps;
use App\Framework;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class FrameworkController extends Controller
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
            'framework_name' => 'required|min:2'
        ]);          
        $framework = new Framework();  
        $framework->framework_name = request('framework_name');
        $framework->save();       
        //return
        return redirect('/frameworks')->with('message', 'Succesvol ingevoerd');          
    }

    //create view
    public function create()
    {      
        $frameworks = new Framework();
        return view('frameworks.create', compact('frameworks'));        
    }

    //update function
    public function update(Request $request, $framework_id)
    {
        $data = $request->validate([
            'framework_name' => 'required|min:2'      
        ]);
        Framework::where('framework_id',$framework_id)->update($data);
        return redirect('/frameworks')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($framework_id)
    {      
        $frameworks = Framework::where('framework_id', $framework_id)->firstOrFail();        
        return view('frameworks.edit', compact('frameworks'));       
    }
    
    //app status list
    public function index()
    {       
        $frameworks = DB::table('frameworks')->paginate(25);
        return view('frameworks.index', ['frameworks' =>$frameworks,]);        
    }
    
    //show app status
    public function show($frameworks)
    {             
        $frameworks = Framework::where('framework_id', $frameworks)->firstOrFail();        
        return view('frameworks.show', compact('frameworks')); 
    }

    //delete app status function
    public function destroy($id)
    {
        $frameworks = Framework::findOrFail($id);
        $frameworks->delete();
        return redirect('/frameworks')->with('message', 'Succesvol verwijderd');
    }
}
