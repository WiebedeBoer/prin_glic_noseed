@extends('layouts.appform')
@section('title')
Library Afhankelijkheden
@endsection
<!--name-->
@section('pagename')
Library Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
        <h2>Library Afhankelijkheid Wijziging</h2>
<form method="POST" action="/libraries/{{ $libraries->library_id }}" class="pb-3">
@method('PATCH')
@include('libraries.form')
<input type="submit" value="wijzig Library Afhankelijkheid" class="btn btn-primary">
@csrf
</form>
@include('libraries.dependencies')
@endsection