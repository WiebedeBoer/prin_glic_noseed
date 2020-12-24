@extends('layouts.appform')
@section('title')
Applicaties Leverancier
@endsection
<!--name-->
@section('pagename')
Applicaties Leverancier
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Applicatie Leverancier Aanmaak</h2>
@if($new_app >=1)
<p><a href="/apps/{{$new_app}}" class="btn btn-primary">Terug naar App</a></p>
@endif
@if($new_person >=1)
<p><a href="/persons/{{$new_person}}" class="btn btn-primary">Terug naar Persoon</a></p>
@endif
<form method="POST" action="/suppliers" class="pb-3">
@include('suppliers.form')
<input type="submit" value="App Leverancier aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection