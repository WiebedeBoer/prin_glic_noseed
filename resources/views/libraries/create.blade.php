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
<h2>Library Afhankelijkheid Aanmaak</h2>
<form method="POST" action="/libraries" class="pb-3">
@include('libraries.form')
<input type="submit" value="Library Afhankelijkheid aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection