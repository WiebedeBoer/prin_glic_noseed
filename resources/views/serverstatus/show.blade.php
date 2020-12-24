@extends('layouts.appshow')
@section('title')
Server status Details voor {{ $serverstatus->server_status }}
@endsection
<!--name-->
@section('pagename')
Server Status Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
    <h2>Wijzig</h2>
<p><a href="/serverstatus/{{ $serverstatus->server_status_id }}/edit" class="btn btn-primary">Wijzig {{ $serverstatus->server_status }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server Status Details</h2>
<ul class="nav navbar-nav">  
    <li class="nav-item">{{ $serverstatus->server_status }}</li>
    <li class="nav-item">{{ $serverstatus->server_status_remarks }}</li>
</ul>
@endsection