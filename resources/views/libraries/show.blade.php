@extends('layouts.appshow')
@section('title')
Library Afhankelijkheden Details voor {{ $libraries->dependency_name }}
@endsection
<!--name-->
@section('pagename')
Library Afhankelijkheden Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/libraries/{{ $libraries->library_id }}/edit" class="btn btn-primary">Wijzig {{ $libraries->dependency_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Library Afhankelijkheden Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">{{ $libraries->dependency_name }}</li>
        <li class="nav-item"><a href="/apps/{{$libraries->app_id}}">{{ $libraries->apps->app_name }}</a></li>
</ul>
@include('libraries.dependencies')
@endsection