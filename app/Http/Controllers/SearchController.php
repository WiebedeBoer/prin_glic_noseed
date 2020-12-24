<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library;
use App\Apps;
use App\Serveros;
use App\Language;
use App\Framework;
use App\Database;
use App\Servers;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //list view
    public function index()
    {       
        
        return view('search.index');        
    }

    //show server
    public function show(Request $request)
    {             
        
        $term = request('term');
        $type = request('type');
        //term
        //check existence
        $term_check = $this->termcheck($type,$term);
        if ($term_check >=1)
        {
            $type_num = $this->typename($type,$term);
            $resultcount = $this->resultscount($type_num,$type);
            //results
            if ($resultcount >=1){
                $results = $this->results($type_num,$type);
            }
            //no results
            else {
                $results =[];
            }

        }
        //nothing found
        else {
            $resultcount =0;
            $type_num =0;
            $results =[];
        }              
        return view('search.show', compact('type','term','type_num','results','resultcount','term_check')); 
    }  
    
    //term check
    private function termcheck($type,$term)
    {
        //os
        if ($type ==1){       
            $term_check = Serveros::where('server_os_name','like',$term)->orWhere('server_os_name',$term)->count();
        }
        //language
        elseif ($type ==2){       
            $term_check = Language::where('language_name','like',$term)->orWhere('language_name',$term)->count();
        }
        //framework
        elseif ($type ==3){       
            $term_check = Framework::where('framework_name','like',$term)->orWhere('framework_name',$term)->count();
        }
        //database
        elseif ($type ==4){       
            $term_check = Database::where('db_name','like',$term)->orWhere('db_name',$term)->count();
        }
        //library
        else {       
            $term_check = Library::where('dependency_name','like',$term)->orWhere('dependency_name',$term)->count();
        }        
        return $term_check;

    }


    //type name
    private function typename($type,$term)
    {
        //os
        if ($type ==1){       
            $type_name = Serveros::where('server_os_name','like',$term)->first(); 
            $type_num = $type_name->server_os_id;
        }
        //language
        elseif ($type ==2){       
            $type_name = Language::where('language_name','like',$term)->first(); 
            $type_num = $type_name->server_os_id;
        }
        //framework
        elseif ($type ==3){       
            $type_name = Framework::where('framework_name','like',$term)->first(); 
            $type_num = $type_name->server_os_id;
        }
        //database
        elseif ($type ==4){       
            $type_name = Database::where('db_name','like',$term)->first(); 
            $type_num = $type_name->server_os_id;
        }
        //library
        else {       
            $type_name = Library::where('dependency_name','like',$term)->first(); 
            $type_num = $type_name->server_os_id;
        } 
        return $type_num;
    }

    //results count
    private function resultscount($type_num,$type)
    {
        //os
        if ($type ==1){       
            $resultcount = Servers::where('server_operating_system', $type_num)->count();
        }
        //language
        elseif ($type ==2){       
            $resultcount = Apps::where('language_dependency', $type_num)->count();
        }
        //framework
        elseif ($type ==3){       
            $resultcount = Apps::where('framework_dependency', $type_num)->count();
        }
        //database
        elseif ($type ==4){       
            $resultcount = Apps::where('database_dependency', $type_num)->count();
        }
        //library
        else {       
            $resultcount = Library::where('library_id', $type_num)->count();
        }        
        return $resultcount;

    }

    //get results
    private function results($type_num,$type)
    {
        //os
        if ($type ==1){      
            $results = Servers::with('servers_status','servers_os')->where('server_operating_system', $type_num)->get();
        }
        //language
        elseif ($type ==2){       
            $results = Apps::with('apps_language','apps_framework','apps_database')->where('language_dependency', $type_num)->orderBy('language_version','DESC')->get();
        }
        //framework
        elseif ($type ==3){       
            $results = Apps::with('apps_language','apps_framework','apps_database')->where('framework_dependency', $type_num)->orderBy('framework_version','DESC')->get();
        }
        //database
        elseif ($type ==4){       
            $results = Apps::with('apps_language','apps_framework','apps_database')->where('database_dependency', $type_num)->get();
        }
        //library
        else {       
            $results = Library::with('apps')->where('library_id', $type_num)->get();
        }        
        return $results;

    }



}
