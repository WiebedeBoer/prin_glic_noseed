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
<h2>Server Service Aanmaak</h2>
<form method="POST" action="/serverservice" class="pb-3">
@include('serverservice.form')
<input type="submit" value="server service aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection