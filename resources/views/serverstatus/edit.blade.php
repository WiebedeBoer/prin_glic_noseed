@extends('layouts.appform')
@section('title')
Server status
@endsection
<!--name-->
@section('pagename')
Server Status
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--content-->
@section('content')
<h2>Server Status Wijziging</h2>
<form method="POST" action="/serverstatus/{{ $serverstatus->server_status_id }}" class="pb-3">
@method('PATCH')
@include('serverstatus.form')
<input type="submit" value="wijzig server status" class="btn btn-primary">
@csrf
</form>
@endsection