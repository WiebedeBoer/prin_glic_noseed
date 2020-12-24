@extends('layouts.appshow')
@section('title')
Roadmap Type Details voor {{ $roadmaptypes->roadmap_update}}
@endsection
<!--name-->
@section('pagename')
Roadmap Type Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/roadmaptypes/{{ $roadmaptypes->id }}/edit" class="btn btn-primary">Wijzig</a></p>
@endsection
<!--content-->
@section('content')
<h2>Roadmap Type Details</h2>
<ul class="nav navbar-nav">  
        
        <li class="nav-item">Server: <a href="/servers/{{ $serverapps->server_id }}">{{ $serverapps->servers->server_name  }}</a></li>
        <li class="nav-item">App: <a href="/apps/{{ $serverapps->app_id }}">{{ $serverapps->apps->app_name  }}</a></li>

        <li class="nav-item">Taak: {{ $roadmaptypes->roadmap_tasks->roadmap_task  }}</li>
        
        <li class="nav-item">Update: {{ $roadmaptypes->roadmap_update  }}</li>
        <li class="nav-item">Start Datum: {{ $roadmaptypes->start_date  }}</li>
        <li class="nav-item">Eind Datum: {{ $roadmaptypes->end_date  }}</li>
</ul>
@endsection