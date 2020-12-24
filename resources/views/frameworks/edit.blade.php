@extends('layouts.appform')
@section('title')
Framework Type Afhankelijkheden
@endsection
<!--name-->
@section('pagename')
Framework Type Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--content-->
@section('content')
        <h2>Framework Type Afhankelijkheid Wijziging</h2>
<form method="POST" action="/frameworks/{{ $frameworks->framework_id }}" class="pb-3">
@method('PATCH')
@include('frameworks.form')
<input type="submit" value="wijzig Framework Type Afhankelijkheid" class="btn btn-primary">
@csrf
</form>
@endsection