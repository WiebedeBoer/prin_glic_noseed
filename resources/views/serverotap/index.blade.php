@extends('layouts.appmain')
@section('title')
Server Otap
@endsection
<!--name-->
@section('pagename')
Server otap
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Server otap Aanmaak</h2>
<p><a href="/serverotap/create" class="btn btn-primary">Voeg server otap toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server otap</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server otap Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($serverotap as $server_otap) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/serverotap/{{ $server_otap->server_otap_id }}">{{ $server_otap->server_otap }}</a></td> 
        <td class="data-tabel"><a href="/serverotap/{{ $server_otap->server_otap_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/serverotap/{{ $server_otap->server_otap_id }}" method="post">
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
          <th class="rug-text-nowrap sortable">Server otap Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $serverotap->links() }}
@endsection