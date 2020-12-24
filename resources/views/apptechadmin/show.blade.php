@extends('layouts.appshow')
@section('title')
App Technisch Beheerder Details voor {{ $apps->app_name }} en {{ $person->person_name }}
@endsection
<!--name-->
@section('pagename')
App Technisch Beheerder Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/apptechadmin/{{ $apptechadmin->id }}/edit" class="btn btn-primary">Wijzig</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Technisch Beheerder Details</h2>
<div class="apps">
<ul class="nav navbar-nav">  
<li class="nav-item"><a href="/persons/{{$person->person_id}}">{{ $person->person_name }}</a></li>
        <li class="nav-item"><a href="/apps/{{$apps->app_id}}">{{ $apps->app_name }}</a></li>
</ul>
@endsection