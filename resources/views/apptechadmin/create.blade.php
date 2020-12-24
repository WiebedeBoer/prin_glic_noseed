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
<h2>Applicatie Technisch Beheerder Aanmaak</h2>
@if($new_app >=1)
<p><a href="/apps/{{$new_app}}" class="btn btn-primary">Terug naar App</a></p>
@endif
@if($new_person >=1)
<p><a href="/persons/{{$new_person}}" class="btn btn-primary">Terug naar Persoon</a></p>
@endif
<form method="POST" action="/apptechadmin" class="pb-3">
@include('apptechadmin.form')
<input type="submit" value="App Technisch Beheerder aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection