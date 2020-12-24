@extends('layouts.appform')
@section('title')
Server Details voor {{ $server->server_name }}
@endsection
<!--name-->
@section('pagename')
Severs
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--content-->
@section('content')
<h2>Server Wijziging</h2>
<form method="POST" action="/servers/{{ $server->server_id }}" class="pb-3">
@method('PATCH')
@include('servers.form')
<input type="submit" value="wijzig server" class="btn btn-primary">
@csrf
</form>
@include('servers.serverapp')
@endsection