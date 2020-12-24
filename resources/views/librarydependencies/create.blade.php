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
<h2>Library Afhankelijkheid binnen Framework Aanmaak</h2>
<form method="POST" action="/librarydependencies" class="pb-3">
@include('librarydependencies.form')
<input type="submit" value="Library Afhankelijkheid binnen Framework aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection