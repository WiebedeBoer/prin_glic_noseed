<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library;
use App\Apps;
use App\LibraryDependency;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class LibraryController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //list view
    public function index()
    {       
        $libraries = Library::with('apps')->paginate(25);
        return view('libraries.index', ['libraries' =>$libraries,]);        
    }

    //edit view
    public function edit($library_id)
    {      
        $libraries = Library::with('apps')->where('library_id', $library_id)->firstOrFail();
        $apps = Apps::all(); 
        
          //library dependencies within
          $librarydependencycount = $this->countlibrary($library_id);
          if ($librarydependencycount >=1){
              $librarydependencies = LibraryDependency::with('libraries')->where('library_id', $library_id)->get(); 
          }
          else {
              $librarydependencies = [];
          }      
        

        return view('libraries.edit', compact('libraries','apps','librarydependencycount','librarydependencies'));       
    }

    //create view
    public function create()
    {      
        $libraries = new Library();
        $apps = Apps::all();
        return view('libraries.create', compact('libraries','apps'));        
    }

    //show view
    public function show($library_id)
    {             
        $libraries = Library::with('apps')->where('library_id', $library_id)->firstOrFail(); 
        //library dependencies within
        $librarydependencycount = $this->countlibrary($library_id);
        if ($librarydependencycount >=1){
            $librarydependencies = LibraryDependency::with('libraries')->where('library_id', $library_id)->get(); 
        }
        else {
            $librarydependencies = [];
        }
        

        return view('libraries.show', compact('libraries','librarydependencycount','librarydependencies')); 
    }

    //delete function
    public function destroy($id)
    {
        $libraries = Library::findOrFail($id);
        $libraries->delete();
        return redirect('/libraries')->with('message', 'Succesvol verwijderd');
    }

    //update function
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'dependency_name' => 'required', 
            'app_id' => 'required'     
        ]);
        Library::where('library_id',$id)->update($data);
        return redirect('/libraries')->with('message', 'Succesvol gewijzigd');
    }

    //store function
    public function store()
    {           
        $data = request()->validate([            
            'dependency_name' => 'required',
            'app_id' => 'required'
        ]);  
        $libraries = new Library();  
        $libraries->dependency_name = request('dependency_name');
        $libraries->app_id = request('app_id');
        $libraries->save();          
        //return
        return redirect('/libraries')->with('message', 'Succesvol ingevoerd');            
    }

    //count app libaries
    private function countlibrary($library_id)
    {
        $librarycount = LibraryDependency::where('library_id', $library_id)->count();
        return $librarycount;
    }


}
