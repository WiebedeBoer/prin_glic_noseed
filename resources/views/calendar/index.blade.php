@extends('layouts.appcontent')
@section('title')
Kalender
@endsection
<!--name-->
@section('pagename')
Kalender
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--content-->
@section('content')
<h2>Kalender {{ $startweek }} - {{ $endweek }}</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Update Datum</th>
          <th class="rug-text-nowrap sortable">Release Wensen</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
        </tr>
    </thead>
    <tbody>
    @if($taskcount >=1)
    @foreach($tasks as $roadmap_task)
        <tr>    
        <td class="data-tabel"><a href="/calendar/{{ $roadmap_task->roadmap_id }}">{{ $roadmap_task->end_date }}</a></td>
        <td class="data-tabel">{{ $roadmap_task->task }}</td>
        <td class="data-tabel"><a href="/calendar/{{ $roadmap_task->roadmap_id }}/edit" class="btn btn-secondary">{{ $roadmap_task->end_date }}</a></td>
        </tr>  
    @endforeach
    @endif
    </tbody>
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Update Datum</th>
          <th class="rug-text-nowrap sortable">Release Wensen</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
        </tr>
    </thead>
</table>
@endsection