@extends('layouts.appform')
@section('title')
Language Types Afhankelijkheden
@endsection
<!--name-->
@section('pagename')
Language Type Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
<h2>Language Type Afhankelijkheid Aanmaak</h2>
<form method="POST" action="/languages" class="pb-3">
@include('languages.form')
<input type="submit" value="Language Types Afhankelijkheid aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection