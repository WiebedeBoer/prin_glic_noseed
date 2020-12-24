@extends('layouts.appshow')
@section('title')
Server en App Details
@endsection
<!--name-->
@section('pagename')
Server en App Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('serverapps.submenu')
@endsection
<!--includes-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/serverapps/{{ $serverapp->id }}/edit" class="btn btn-primary">Wijzig</a></p>
@endsection
<!--addcontent-->
@section('content')
<h2>Server en App Details</h2>
<ul class="nav navbar-nav">   
        <li class="nav-item">Server: <a href="/servertype/{{ $serverapp->server_id }}">{{ $serverapp->servers->server_name }}</a></li>
        <li class="nav-item">App: <a href="/serverotap/{{ $serverapp->app_id }}">{{ $serverapp->apps->app_name }}</a></li>
        <li class="nav-item">Gewenste Taal en Versie: {{ $serverapp->apps_language->language_name }} {{ $serverapp->language_version }}</li>
        <li class="nav-item">Gewenste Framework en Versie: {{ $serverapp->apps_framework->framework_name }} {{ $serverapp->framework_version }}</li>
        <li class="nav-item">Gewenste Database: {{ $serverapp->apps_database->db_name }}</li>
</ul>
@endsection