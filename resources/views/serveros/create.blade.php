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
<h2>Server Operating System Aanmaak</h2>
<form method="POST" action="/serveros" class="pb-3">
@include('serveros.form')
<input type="submit" value="server OS aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection