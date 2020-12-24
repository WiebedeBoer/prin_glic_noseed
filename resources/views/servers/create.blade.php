@extends('layouts.appform')
@section('title')
Servers
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
<h2>Server Registratie</h2>
<form method="POST" action="/servers" class="pb-3">
@include('servers.form')
<input type="submit" value="registreer server" class="btn btn-primary">
@csrf
</form>
@endsection