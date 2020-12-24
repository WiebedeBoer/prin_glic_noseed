@extends('layouts.appextra')
@section('title')
App Details voor {{ $apps->app_name }}
@endsection
<!--name-->
@section('pagename')
App Details voor {{ $apps->app_name }}
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Wijzig</h2>
<p><a href="/apps/{{ $apps->app_id }}/edit" class="btn btn-primary">Wijzig {{ $apps->app_name }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Details voor <a href="/privacy/{{ $apps->app_id }}">{{ $apps->app_name }}</a></h2>
<ul class="nav navbar-nav">   
        <li class="nav-item">App: {{ $apps->app_name }}</li>
        <li class="nav-item">Status: {{ $apps->apps_status->app_status }}</li>
        <li class="nav-item">URL: <a href="{{ $apps->app_url }}">{{ $apps->app_url }}</a></li>
        <li class="nav-item">Taal en Versie: {{ $apps->apps_language->language_name }} {{ $apps->language_version }}</li>
        <li class="nav-item">Framework en Versie: {{ $apps->apps_framework->framework_name }} {{ $apps->framework_version }}</li>
        <li class="nav-item">Database: {{ $apps->apps_database->db_name }}</li>
        <li class="nav-item">DVO: {{ $apps->apps_database->dvo }}</li>
        <li class="nav-item">DVO link: <a href="{{ $apps->dvo_link }}">{{ $apps->apps_database->dvo_link }}</a></li>
        <li class="nav-item">SLA: {{ $apps->apps_database->sla }}</li>
        <li class="nav-item">SLA Link: <a href="{{ $apps->sla_link }}">{{ $apps->apps_database->sla_link }}</a></li>
        <li class="nav-item">Opmerkingen: {{ $apps->app_remarks }}</li>
</ul>
@endsection
@section('addition')
@include('apps.serverapp')
@include('apps.persons')
@include('apps.libraries')
@endsection