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
<h2>Applicatie Functioneel Beheerder Wijziging</h2>
<form method="POST" action="/appfunctionaladmin/{{ $appfunctionaladmin->id }}" class="pb-3">
@method('PATCH')
@include('appfunctionaladmin.form')
<input type="submit" value="wijzig App Functioneel Beheerder" class="btn btn-primary">
@csrf
</form>
@endsection