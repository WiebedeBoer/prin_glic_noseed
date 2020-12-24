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
        <h2>Applicatie Status Wijziging</h2>
<form method="POST" action="/appstatus/{{ $appstatus->app_status_id }}" class="pb-3">
@method('PATCH')
@include('appstatus.form')
<input type="submit" value="wijzig app status" class="btn btn-primary">
@csrf
</form>
@endsection