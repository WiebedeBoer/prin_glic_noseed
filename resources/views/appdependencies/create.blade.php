@extends('layouts.appform')
@section('title')
Applicaties Dependencies
@endsection
<!--name-->
@section('pagename')
Applicaties Dependencies
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('appdependencies.submenu')
@endsection
<!--content-->
@section('content')
<h2>Applicatie Dependency Aanmaak</h2>
<form method="POST" action="/appdependencies" class="pb-3">
@include('appdependencies.form')
<input type="submit" value="aanmaak app afhankelijk" class="btn btn-primary">
@csrf
</form>
@endsection