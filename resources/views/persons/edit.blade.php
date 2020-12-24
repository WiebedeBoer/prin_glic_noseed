@extends('layouts.appform')
@section('title')
Persoon
@endsection
<!--name-->
@section('pagename')
Persoon
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('persons.submenu')
@endsection
<!--content-->
@section('content')
        <h2>Persoon Wijziging</h2>
<form method="POST" action="/persons/{{ $persons->person_id }}" class="pb-3">
@method('PATCH')
@include('persons.form')
<input type="submit" value="wijzig persoon" class="btn btn-primary">
@csrf
</form>
@include('persons.apps')
@endsection