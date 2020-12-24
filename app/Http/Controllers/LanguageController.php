<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Apps;
use App\Language;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class LanguageController extends Controller
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
            'language_name' => 'required|min:2'
        ]);          
        $language = new Language();  
        $language->language_name = request('language_name');
        $language->save();       
        //return
        return redirect('/languages')->with('message', 'Succesvol ingevoerd');          
    }

    //create view
    public function create()
    {      
        $languages = new Language();
        return view('languages.create', compact('languages'));        
    }

    //update function
    public function update(Request $request, $language_id)
    {
        $data = $request->validate([
            'language_name' => 'required|min:2'      
        ]);
        Language::where('language_id',$language_id)->update($data);
        return redirect('/languages')->with('message', 'Succesvol gewijzigd');
    }

    //edit view
    public function edit($language_id)
    {      
        $languages = Language::where('language_id', $language_id)->firstOrFail();        
        return view('languages.edit', compact('languages'));       
    }
    
    //app status list
    public function index()
    {       
        $languages = DB::table('languages')->paginate(25);
        return view('languages.index', ['languages' =>$languages,]);        
    }
    
    //show app status
    public function show($language_id)
    {             
        $languages = Language::where('language_id', $language_id)->firstOrFail();        
        return view('languages.show', compact('languages')); 
    }

    //delete app status function
    public function destroy($id)
    {
        $languages = Language::findOrFail($id);
        $languages->delete();
        return redirect('/languages')->with('message', 'Succesvol verwijderd');
    }
}
