@extends('layouts.appform')
@section('title')
Library Afhankelijkheden binnen Framework
@endsection
<!--name-->
@section('pagename')
Library Afhankelijkheden binnen Framework
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
        <h2>Library Afhankelijkheid binnen Framework Wijziging</h2>
<form method="POST" action="/librarydependencies/{{ $libaries->library_id }}" class="pb-3">
@method('PATCH')
@include('librarydependencies.form')
<input type="submit" value="wijzig Library binnen Framework Afhankelijkheid" class="btn btn-primary">
@csrf
</form>
@endsection