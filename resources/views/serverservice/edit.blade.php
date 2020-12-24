@extends('layouts.appform')
@section('title')
Server service
@endsection
<!--name-->
@section('pagename')
Server Service
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--content-->
@section('content')
<h2>Server Service Wijziging</h2>
<form method="POST" action="/serverservice/{{ $serverservice->server_service_id }}" class="pb-3">
@method('PATCH')
@include('serverservice.form')
<input type="submit" value="wijzig server service" class="btn btn-primary">
@csrf
</form>
@endsection