@extends('layouts.appshow')
@section('title')
Server service Details voor {{ $serverservice->server_service }}
@endsection
<!--name-->
@section('pagename')
Server Service Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
    <h2>Wijzig</h2>
<p><a href="/serverservice/{{ $serverservice->server_service_id }}/edit" class="btn btn-primary">Wijzig {{ $serverservice->server_service }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server Service Details</h2>
<ul class="nav navbar-nav">  
    <li class="nav-item">{{ $serverservice->server_service }}</li>
    <li class="nav-item">{{ $serverservice->server_service_description }}</li>
</ul>
@endsection