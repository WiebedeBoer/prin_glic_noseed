@extends('layouts.appshow')
@section('title')
App Eigenaar Details voor {{ $person->person_name }} en {{ $apps->app_name }}
@endsection
<!--name-->
@section('pagename')
App Eigenaar Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/appowner/{{ $appowner->id }}/edit" class="btn btn-primary">Wijzig</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Eigenaar Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item"><a href="/persons/{{$person->person_id}}">{{ $person->person_name }}</a></li>
        <li class="nav-item"><a href="/apps/{{$apps->app_id}}">{{ $apps->app_name }}</a></li>
</ul>
@endsection