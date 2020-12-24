@extends('layouts.appform')
@section('title')
Roadmap
@endsection
<!--name-->
@section('pagename')
Roadmap
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--content-->
@section('content')
<h2>Roadmap Aanmaak</h2>
<form method="POST" action="/roadmaps" class="pb-3">
@include('roadmaps.form')
<input type="submit" value="Roadmap aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection