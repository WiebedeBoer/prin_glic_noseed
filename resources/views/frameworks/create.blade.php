@extends('layouts.appform')
@section('title')
Framework Types Afhankelijkheden
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
<h2>Framework Type Afhankelijkheid Aanmaak</h2>
<form method="POST" action="/frameworks" class="pb-3">
@include('frameworks.form')
<input type="submit" value="Framework Types Afhankelijkheid aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection