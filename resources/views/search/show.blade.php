@extends('layouts.appsearch')
@section('title')
Zoekresultaten
@endsection
<!--name-->
@section('pagename')
Zoekresultaten
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('search.submenu')
@endsection
<!--content-->
@section('content')
<h2>Zoekresultaten</h2>
<p>zoekterm: {{$term}}, resultaten: {{$resultcount}}</p>
@if($resultcount >=1)
@if($type==1)
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($results as $result) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/servers/{{ $result->server_id }}">{{ $result->server_name }}</a></td> 
        <td class="data-tabel"><a href="/servers/{{ $result->server_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/servers/{{ $result->server_id }}" method="post">
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
            <th class="rug-text-nowrap sortable">Server</th>
            <th class="rug-text-nowrap sortable">Wijzig</th>
            <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@else
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">App</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($results as $result) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/apps/{{ $result->app_id }}">{{ $result->app_name }}</a></td>  
        <td class="data-tabel"><a href="/apps/{{ $result->app_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/apps/{{ $result->app_id }}" method="post">
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
            <th class="rug-text-nowrap sortable">Wijzig</th>
            <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endif
@endif
@endsection
<!--links-->
@section('listlinks')

@endsection