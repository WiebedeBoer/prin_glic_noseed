<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Servers;
use App\Servertype;
use App\Serverotap;
use App\Serverstatus;
use App\Serverservice;
use App\Serveros;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CostsExport;

class CostController extends Controller
{
 
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //server costs list
    public function index(Request $request)
    {       
       
        $sorttype = $request->query('sort');

        if ($sorttype =="server_name"){
            $servers = Servers::with('servers_status','servers_service','serverapps_count')->orderBy($sorttype,'ASC')->get();
        }
        elseif ($sorttype =="server_status"){
            $servers = Servers::with('servers_status','servers_service','serverapps_count')->orderBy($sorttype,'ASC')->get();
        }
        elseif ($sorttype =="server_service"){
            $servers = Servers::with('servers_status','servers_service','serverapps_count')->orderBy($sorttype,'ASC')->get();
        }
        elseif ($sorttype =="server_costs"){
            $servers = Servers::with('servers_status','servers_service','serverapps_count')->orderBy($sorttype,'ASC')->get();
        }
        elseif ($sorttype =="memory_costs"){
            $servers = Servers::with('servers_status','servers_service','serverapps_count')->orderBy($sorttype,'ASC')->get();
        }
        elseif ($sorttype =="sla_costs"){
            $servers = Servers::with('servers_status','servers_service','serverapps_count')->orderBy($sorttype,'ASC')->get();
        }
        else {
            $servers = Servers::all();
        } 
        
        $servers_count = $this->count_servers();
        $apps_count = $this->count_apps();
        $status_count = $this->count_status();
        $service_count = $this->count_service();
        $sum_server_costs = $this->sum_server_costs();
        $sum_memory_costs = $this->sum_memory_costs();
        $sum_sla_costs = $this->sum_sla_costs();
        $server_costs_per_status = $this->server_costs_per_status();
        $server_costs_per_service = $this->server_costs_per_service();
        return view('costs.index', compact('servers','servers_count','apps_count','status_count','service_count','sum_server_costs','sum_memory_costs','sum_sla_costs','server_costs_per_status','server_costs_per_service'));        
    }

    //count apps
    private function count_apps()
    {       
        $apps_count = DB::table('apps')->count();
        return $apps_count;        
    }

    //count servers
    private function count_servers()
    {       
        $servers_count = DB::table('servers')->count();
        return $servers_count;        
    }

    //count servers status
    private function count_status()
    {       
        $status_count = DB::table('server_status')->count();
        return $status_count;        
    }

    //count servers service
    private function count_service()
    {       
        $service_count = DB::table('server_service')->count();
        return $service_count;        
    }

    //sum server costs
    private function sum_server_costs()
    {       
        $sum_server_costs = DB::table('servers')->sum('server_costs');
        return $sum_server_costs;        
    }

    //sum memory costs
    private function sum_memory_costs()
    {       
        $sum_memory_costs = DB::table('servers')->sum('memory_costs');
        return $sum_memory_costs;     
    }

    //sum memory costs
    private function sum_sla_costs()
    {       
        $sum_sla_costs = DB::table('servers')->sum('sla_costs');
        return $sum_sla_costs;     
    }

    //server costs per server status
    private function server_costs_per_status()
    {                      
        $server_costs_per_status = Servers::with('servers_status')
        ->select('server_status', DB::raw('SUM(server_costs) as servercosts,SUM(memory_costs) as memorycosts,SUM(sla_costs) as slacosts'))
        ->groupBy('server_status');
        $server_costs_per_status = $server_costs_per_status->get();
        return $server_costs_per_status;      
    }

    //server costs per server service
    private function server_costs_per_service()
    {                      
        $server_costs_per_service = Servers::with('servers_service')
        ->select('server_service', DB::raw('SUM(server_costs) as servercosts,SUM(memory_costs) as memorycosts,SUM(sla_costs) as slacosts'))
        ->groupBy('server_service');
        $server_costs_per_service = $server_costs_per_service->get();
        return $server_costs_per_service;      
    }

    //show server
    public function show($server)
    {             
        $server = Servers::where('server_id', $server)->firstOrFail();
        $server_type_id = $server->server_type;
        $server_otap_id = $server->server_otap;
        $server_service_id = $server->server_service;
        $server_status_id = $server->server_status;
        $server_os_id = $server->server_operating_system;
        $servertype = Servertype::where('server_type_id', $server_type_id)->firstOrFail();
        $serverotap = Serverotap::where('server_otap_id', $server_otap_id)->firstOrFail();
        $serverservice = Serverservice::where('server_service_id', $server_service_id)->firstOrFail();
        $serverstatus = Serverstatus::where('server_status_id', $server_status_id)->firstOrFail(); 
        $serveros = Serveros::where('server_os_id', $server_os_id)->firstOrFail();       
        return view('costs.show', compact('server','servertype','serverotap','serverservice','serverstatus','serveros')); 
    }

    //delete server function
    public function destroy($id)
    {
        $server = Servers::findOrFail($id);
        $server->delete();    
        return redirect('/costs')->with('message', 'Succesvol verwijderd');
    }



    /**
    * @return \Illuminate\Support\Collection
    */

    //print excel
    public function export() 
    {
        return Excel::download(new CostsExport, 'costs.csv');
    }




}