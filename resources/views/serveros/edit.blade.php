@extends('layouts.appform')
@section('title')
Server Operating System
@endsection
<!--name-->
@section('pagename')
Server Operating System
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--content-->
@section('content')
<h2>Server Operating System Wijziging</h2>
<form method="POST" action="/serveros/{{ $serveros->server_os_id }}" class="pb-3">
@method('PATCH')
@include('serveros.form')
<input type="submit" value="wijzig server OS" class="btn btn-primary">
@csrf
</form>
@endsection