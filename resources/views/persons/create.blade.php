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
<h2>Persoon Aanmaak</h2>
<form method="POST" action="/persons" class="pb-3">
@include('persons.form')
<input type="submit" value="Persoon aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection