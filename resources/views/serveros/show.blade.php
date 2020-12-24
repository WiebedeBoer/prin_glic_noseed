@extends('layouts.appshow')
@section('title')
Server Operating System Details voor {{ $serveros->server_os_name }}
@endsection
<!--name-->
@section('pagename')
Server Operating System Details
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
    <h2>Wijzig</h2>
<p><a href="/serveros/{{ $serveros->server_os_id }}/edit" class="btn btn-primary">Wijzig {{ $serveros->server_os }}</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server Operating System Details</h2>
<ul class="nav navbar-nav">  
    <li class="nav-item">OS naam: {{ $serveros->server_os_name }}</li>
    <li class="nav-item">Code naam: {{ $serveros->code_name }}</li>
    <li class="nav-item">Release Datum: {{ $serveros->release }}</li>
    <li class="nav-item">Einde Support: {{ $serveros->end_of_support }}</li>
    <li class="nav-item">Beschrijving: {{ $serveros->server_os_description }}</li>
</ul>
@if($resultcount >=1)
<h2>Servers</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>

        </tr>
    </thead>
    <tbody>
    @foreach($results as $result) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/servers/{{ $result->server_id }}">{{ $result->server_name }}</a></td> 
        <td class="data-tabel"><a href="/servers/{{ $result->server_id }}/edit" class="btn btn-secondary">Wijzig</a></td>  
        </tr>
    @endforeach
    </tbody>
    <thead>
        <tr>
            <th class="rug-text-nowrap sortable">Server</th>
            <th class="rug-text-nowrap sortable">Wijzig</th>
        </tr>
    </thead>
</table>
@endif
@endsection