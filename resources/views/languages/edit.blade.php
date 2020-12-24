@extends('layouts.appform')
@section('title')
Language Type Afhankelijkheden
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
        <h2>Language Type Afhankelijkheid Wijziging</h2>
<form method="POST" action="/languages/{{ $languages->language_id }}" class="pb-3">
@method('PATCH')
@include('languages.form')
<input type="submit" value="wijzig Language Type Afhankelijkheid" class="btn btn-primary">
@csrf
</form>
@endsection