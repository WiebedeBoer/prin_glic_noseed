@extends('layouts.appform')
@section('title')
Roadmap Deel
@endsection
<!--name-->
@section('pagename')
Roadmap Deel
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--content-->
@section('content')
<h2>Roadmap Deel Aanmaak</h2>
<form method="POST" action="/roadmaptasks" class="pb-3">
@include('roadmaptasks.form')
<input type="submit" value="Roadmap Deel aanmaken" class="btn btn-primary">
@csrf
</form>
@endsection