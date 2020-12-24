@extends('layouts.appform')
@section('title')
Applicaties Functioneel Beheerder
@endsection
<!--name-->
@section('pagename')
Applicaties Functioneel Beheerder
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Applicatie Functioneel Beheerder Aanmaak</h2>
@if($new_app >=1)
<p><a href="/apps/{{$new_app}}" class="btn btn-primary">Terug naar App</a></p>
@endif
@if($new_person >=1)
<p><a href="/persons/{{$new_person}}" class="btn btn-primary">Terug naar Persoon</a></p>
@endif
<form method="POST" action="/appfunctionaladmin" class="pb-3">
@include('appfunctionaladmin.form')
<input type="submit" value="App Functioneel Beheerder aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection