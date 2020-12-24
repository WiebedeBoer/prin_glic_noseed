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
        <h2>Roadmap Type Wijziging</h2>
<form method="POST" action="/roadmaptypes/{{ $roadmaptypes->id }}" class="pb-3">
@method('PATCH')
@include('roadmaptypes.form')
<input type="submit" value="wijzig roadmap type" class="btn btn-primary">
@csrf
</form>
@endsection