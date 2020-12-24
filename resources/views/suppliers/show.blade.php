@extends('layouts.appshow')
@section('title')
App Leverancier Details voor {{ $apps->app_name }} en {{ $person->person_name }}
@endsection
<!--name-->
@section('pagename')
App Leverancier Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/suppliers/{{ $appsupplier->id }}/edit" class="btn btn-primary">Wijzig {{ $appsupplier->apps->app_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Leverancier Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">{{ $person->person_name }}</li>
        <li class="nav-item">{{ $apps->app_name }}</li>
</ul>
@endsection