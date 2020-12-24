@extends('layouts.appshow')
@section('title')
Server type Details voor {{ $servertype->server_type }}
@endsection
<!--name-->
@section('pagename')
Server Type Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/servertype/{{ $servertype->server_type_id }}/edit" class="btn btn-primary">Wijzig {{ $servertype->server_type }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server Type Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">{{ $servertype->server_type }}</li>
</ul>
@endsection