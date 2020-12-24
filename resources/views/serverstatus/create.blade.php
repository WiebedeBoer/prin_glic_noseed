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
<h2>Server Status Aanmaak</h2>
<form method="POST" action="/serverstatus" class="pb-3">
@include('serverstatus.form')
<input type="submit" value="server status aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection