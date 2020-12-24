@extends('layouts.appform')
@section('title')
Applicaties Eigenaar
@endsection
<!--name-->
@section('pagename')
Applicaties Eigenaar
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Applicatie Eigenaar Wijziging</h2>
<form method="POST" action="/appowner/{{ $appowner->id }}" class="pb-3">
@method('PATCH')
@include('appowner.form')
<input type="submit" value="wijzig app eigenaar" class="btn btn-primary">
@csrf
</form>
@endsection