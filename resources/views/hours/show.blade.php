@extends('layouts.appshow')
@section('title')
Urenschatting Details
@endsection
<!--name-->
@section('pagename')
Urenschatting Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Wijzig</h2>
<p><a href="/hours/{{ $estimate->estimate_id }}/edit" class="btn btn-primary">Wijzig {{ $server_apps->apps->app_name }} {{ $server_apps->servers->server_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Urenschatting voor {{ $server_apps->apps->app_name }} {{ $server_apps->servers->server_name }}</h2>
<ul class="nav navbar-nav">   
        <li class="nav-item">Van app: {{ $server_apps->apps->app_name }}</li>
        <li class="nav-item">Op Server: {{ $server_apps->servers->server_name}}</li>
        <li class="nav-item">Status: 
        @if ($estimate->status ==1)
            huidig
        @else
            archief
        @endif
        </li>
        <li class="nav-item">Urenschatting: {{ $estimate->hour_estimate }}</li>
        <li class="nav-item">Update en Release: {{ $estimate->hour_update }}</li>   
        <li class="nav-item">Roadmap: 
        @if($estimate->roadmap_id !=0)
            <a href="roadmap/{{ $estimate->estimate_id }}">Roadmap</a>
        @endif
        </li>
        <li class="nav-item">Trello Board: <a href="{{ $estimate->trello_board }}">{{ $estimate->trello_board }}</a></li>
</ul>
@endsection