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
<h2>Server otap Aanmaak</h2>
<form method="POST" action="/serverotap" class="pb-3">
@include('serverotap.form')
<input type="submit" value="server otap aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection