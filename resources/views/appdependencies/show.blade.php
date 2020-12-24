@extends('layouts.appshow')
@section('title')
App Dependencies Details
@endsection
<!--name-->
@section('pagename')
App Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('appdependencies.submenu')
@endsection
<!--content-->
@section('addcontent')
<h2>Wijzig</h2>
<p><a href="/appdependencies/{{ $apps->id }}/edit" class="btn btn-primary">Wijzig</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Dependencies Details</h2>
<ul class="nav navbar-nav">   
        <li class="nav-item"><a href="/apps/{{ $apps->app_id }}">App: {{ $apps->apps->app_name }}</a></li>
        <li class="nav-item"><a href="/apps/{{ $apps->dependent_app_id }}">Afhankelijke App: {{ $apps->dependent_apps->app_name }}</a></li>

</ul>
@endsection