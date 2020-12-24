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
        <h2>Roadmap Wijziging</h2>
<form method="POST" action="/roadmaps/{{ $roadmap->roadmap_id }}" class="pb-3">
@method('PATCH')
@include('roadmaps.form')
<input type="submit" value="wijzig roadmap" class="btn btn-primary">
@csrf
</form>
@endsection