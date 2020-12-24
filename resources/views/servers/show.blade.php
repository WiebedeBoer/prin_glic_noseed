@extends('layouts.appshow')
@section('title')
Server Details voor {{ $server->server_name }}
@endsection
<!--name-->
@section('pagename')
Server Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Wijzig {{ $server->server_name }}</h2>
<p><a href="/servers/{{ $server->server_id }}/edit" class="btn btn-primary">Wijzig {{ $server->server_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server Details</h2>
<ul class="nav navbar-nav">   
        <li class="nav-item">Server naam: {{ $server->server_name }}</li>
        <li class="nav-item">Server type: <a href="/servertype/{{ $server->server_type }}">{{ $servertype->server_type }}</a></li>
        <li class="nav-item">Server otap: <a href="/serverotap/{{ $server->server_otap }}">{{ $serverotap->server_otap }}</a></li>
        <li class="nav-item">Server service: <a href="/serverservice/{{ $server->server_service }}">{{ $serverservice->server_service }}</a></li>
        <li class="nav-item">Server status: <a href="/serverstatus/{{ $server->server_status }}">{{ $serverstatus->server_status }}</a></li>
        <li class="nav-item">Server operating system: <a href="/serveros/{{ $server->server_operating_system }}">{{ $serveros->server_os_name }}</a></li>
        <li class="nav-item">Server kosten: {{ $server->server_costs }}</li>
        <li class="nav-item">Geheugen kosten: {{ $server->memory_costs }}</li>
        <li class="nav-item">SLA kosten (app extern): {{ $server->sla_costs }}</li>
        <li class="nav-item">Acquisitie Datum: {{ $server->server_acquisition }}</li>
        <li class="nav-item">Terminatie datum: {{ $server->server_termination }}</li>
        <li class="nav-item">Certificaat Datum: {{ $server->server_certificate_expiration }}</li>
        <li class="nav-item">Machine: {{ $server->server_machine }}</li>
        <li class="nav-item">Opmerkingen: {{ $server->server_remarks }}</li>
</ul>
@include('servers.serverapp')
@endsection