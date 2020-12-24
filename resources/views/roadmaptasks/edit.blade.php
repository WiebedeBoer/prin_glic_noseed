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
        <h2>Roadmap Deel Wijziging</h2>
<form method="POST" action="/roadmaptasks/{{ $roadmaptask->task_id }}" class="pb-3">
@method('PATCH')
@include('roadmaptasks.form')
<input type="submit" value="wijzig roadmap deel" class="btn btn-primary">
@csrf
</form>
@endsection