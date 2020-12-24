@extends('layouts.appmain')
@section('title')
Urenschatting
@endsection
<!--name-->
@section('pagename')
Urenschatting &amp; Roadmap
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Export</h2>
<p><a href="/hours/export" class="btn btn-primary" class="btn btn-primary">Print Excel</a></p>
@endsection
<!--content-->
@section('content')
<h2>Uren</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">App</th>
          <th class="rug-text-nowrap sortable">Server</th>
          <th class="rug-text-nowrap sortable">Roadmap</th>
          <th class="rug-text-nowrap sortable">Urenschatting</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($estimates as $estimate)
        <tr>    
        <td class="data-tabel">
        <a href="/apps/{{ $estimate->servers_apps->app_id }}">{{$estimate->app_name}}</a>
        </td> 
        <td class="data-tabel">
        <a href="/servers/{{ $estimate->servers_apps->server_id }}">{{$estimate->server_name}}</a>
        </td> 
        <td class="data-tabel">
        @if($estimates->roadmap_id !=0)
        <a href="/roadmap/{{ $estimate->roadmap_id }}">Roadmap</a>
        @endif
        </td> 
        <td class="data-tabel">
        <a href="/hours/{{ $estimate->estimate_id }}">{{ $estimates->hour_estimate }}</a>
        </td> 
        <td class="data-tabel">
        <a href="/hours/{{ $estimate->estimate_id }}/edit" class="btn btn-secondary">Wijzig</a>
        </td> 
        <td class="data-tabel">
        <form action="/hours/{{ $estimate->estimate_id }}" method="post">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger" type="submit">Verwijder</button>
        </form>
        </td> 
        </tr>  
    @endforeach
    </tbody>
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">App</th>
          <th class="rug-text-nowrap sortable">Server</th>
          <th class="rug-text-nowrap sortable">Roadmap</th>
          <th class="rug-text-nowrap sortable">Urenschatting</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $estimates->links() }}
@endsection