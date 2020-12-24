@extends('layouts.appform')
@section('title')
Applicaties Status
@endsection
<!--name-->
@section('pagename')
Applicaties Status
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Applicatie Status Aanmaak</h2>
<form method="POST" action="/appstatus" class="pb-3">
@include('appstatus.form')
<input type="submit" value="app status aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection