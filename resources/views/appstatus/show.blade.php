@extends('layouts.appshow')
@section('title')
App Status Details voor {{ $appstatus->app_status }}
@endsection
<!--name-->
@section('pagename')
App Status Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/appstatus/{{ $appstatus->app_status_id }}/edit" class="btn btn-primary">Wijzig {{ $appstatus->app_status }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Status Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">{{ $appstatus->app_status }}</li>
</ul>
@endsection