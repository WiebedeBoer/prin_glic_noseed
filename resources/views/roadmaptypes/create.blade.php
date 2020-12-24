@extends('layouts.appform')
@section('title')
Roadmap Type
@endsection
<!--name-->
@section('pagename')
Roadmap Type
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--content-->
@section('content')
<h2>Roadmap Type Aanmaak</h2>
<form method="POST" action="/roadmaptypes" class="pb-3">
@include('roadmaptypes.form')
<input type="submit" value="Roadmap Type aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection