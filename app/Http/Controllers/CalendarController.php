<?php

namespace App\Http\Controllers;

use App\PersonTask;
use App\Estimate;
use App\Roadmap;
use App\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    //authenticate
    public function __construct()
    {
        $this->middleware('auth');
    }

    //calendar list
    public function index()
    {       
        //$servers = Servers::with('servers_status','servers_os')->paginate(25);
        //return view('calendar.index', ['servers' =>$servers,]); 

        $startweek = date('Y-m-d');
        $endtimecount = strtotime("+7 day");
        $endweek =date('Y-m-d', $endtimecount);
        $tasks = PersonTask::with('persons','roadmaps')->orderBy('end_date', 'asc')->whereBetween('end_date', [$startweek, $endweek])->get();
        $taskcount = PersonTask::with('persons','roadmaps')->whereBetween('end_date', [$startweek, $endweek])->count(); 
        return view('calendar.index', compact('tasks','taskcount','startweek','endweek'));   
    }
}
