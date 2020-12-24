@extends('layouts.appshow')
@section('title')
Roadmap Deel Details voor {{ $roadmaptask->roadmap_task }}
@endsection
<!--name-->
@section('pagename')
Roadmap Deel Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
        <h2>Wijzig</h2>
<p><a href="/roadmaptasks/{{ $roadmaptask->task_id }}/edit" class="btn btn-primary">Wijzig {{ $roadmaptask->roadmap_task }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Roadmap Deel Details</h2>
<ul class="nav navbar-nav">  
        <li class="nav-item">{{ $roadmaptask->roadmap_task  }}</li>
</ul>
@endsection