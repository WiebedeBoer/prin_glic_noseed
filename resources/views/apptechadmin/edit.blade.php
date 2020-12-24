@extends('layouts.appform')
@section('title')
Applicaties Technisch Beheerder
@endsection
<!--name-->
@section('pagename')
Applicaties Technisch Beheerder
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Applicatie Technisch Beheerder Wijziging</h2>
<form method="POST" action="/apptechadmin/{{ $apptechadmin->id }}" class="pb-3">
@method('PATCH')
@include('apptechadmin.form')
<input type="submit" value="wijzig App Technisch Beheerder" class="btn btn-primary">
@csrf
</form>
@endsection