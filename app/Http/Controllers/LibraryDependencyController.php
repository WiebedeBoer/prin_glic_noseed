<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LibraryDependency;
use App\Library;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class LibraryDependencyController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //roadmap list
    public function index()
    {       
        $libraries = LibraryDependency::with('libraries')->paginate(25);
        return view('librarydependencies.index', ['libraries' =>$libraries,]);        
    }

    //edit view
    public function edit($dependency_id)
    {      
        $libraries = LibraryDependency::with('libraries')->where('dependency_id', $dependency_id)->firstOrFail();
        $apps_library = Library::all();            
        return view('librarydependencies.edit', compact('libraries','apps_library'));       
    }

    //create view
    public function create()
    {      
        $libraries = new LibraryDependency();
        $apps_library = Library::all();
        return view('librarydependencies.create', compact('libraries','apps_library'));        
    }

    //show view
    public function show($dependency_id)
    {             
        $libraries = LibraryDependency::with('libraries')->where('dependency_id', $dependency_id)->firstOrFail();     
        return view('librarydependencies.show', compact('libraries')); 
    }

    //delete function
    public function destroy($id)
    {
        $libraries = LibraryDependency::findOrFail($id);
        $libraries->delete();
        return redirect('/librarydependencies')->with('message', 'Succesvol verwijderd');
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'dependency_name' => 'required', 
            'library_id' => 'required',
            'dependency_description' => 'nullable'     
        ]);
        LibraryDependency::where('dependency_id',$id)->update($data);
        return redirect('/librarydependencies')->with('message', 'Succesvol gewijzigd');
    }

    //store function
    public function store()
    {           
        $data = request()->validate([            
            'dependency_name' => 'required',
            'library_id' => 'required',
            'dependency_description' => 'nullable'
        ]);  
        $librarydependency = new LibraryDependency();  
        $librarydependency->dependency_name = request('dependency_name');
        $librarydependency->library_id = request('library_id');
        $librarydependency->dependency_description = request('dependency_description');
        $librarydependency->save();          
        //return
        return redirect('/librarydependencies')->with('message', 'Succesvol ingevoerd');            
    }


}
