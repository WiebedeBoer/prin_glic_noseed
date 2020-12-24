@extends('layouts.appform')
@section('title')
Server Otap
@endsection
<!--name-->
@section('pagename')
Server otap
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--content-->
@section('content')
<h2>Server otap Wijziging</h2>
<form method="POST" action="/serverotap/{{ $serverotap->server_otap_id }}" class="pb-3">
@method('PATCH')
@include('serverotap.form')
<input type="submit" value="wijzig server otap" class="btn btn-primary">
@csrf
</form>
@endsection