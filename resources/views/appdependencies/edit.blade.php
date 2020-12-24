@extends('layouts.appform')
@section('title')
Apps en Apps koppeling Details voor {{ $appdependency->apps->app_name }}
@endsection
@section('pagename')
Apps &amp; Apps Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('appdependencies.submenu')
@endsection
<!--content-->
@section('content')
<h2>App en App Wijziging</h2>
<form method="POST" action="/appdependencies/{{ $appdependency->id }}" class="pb-3">
@method('PATCH')
@include('appdependencies.form')
<input type="submit" value="wijzig app en app afhankelijkheid" class="btn btn-primary">
@csrf
</form>
@endsection