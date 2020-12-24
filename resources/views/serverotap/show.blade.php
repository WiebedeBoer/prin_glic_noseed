@extends('layouts.appshow')
@section('title')
Server Otap Details voor {{ $serverotap->server_otap }}
@endsection
<!--name-->
@section('pagename')
Server otap Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/serverotap/{{ $serverotap->server_otap_id }}/edit" class="btn btn-primary">Wijzig {{ $serverotap->server_otap }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server Otap Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">Server otap: {{ $serverotap->server_otap }}</li>
</ul>
@endsection