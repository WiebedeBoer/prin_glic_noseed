@extends('layouts.appmain')
@section('title')
Server Status
@endsection
<!--name-->
@section('pagename')
Server Status
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Server Status Aanmaak</h2>
<p><a href="/serverstatus/create" class="btn btn-primary">Voeg server Status toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server Status</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server Status Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($serverstatus as $server_status) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/serverstatus/{{ $server_status->server_status_id }}">{{ $server_status->server_status }}</a></td> 
        <td class="data-tabel"><a href="/serverstatus/{{ $server_status->server_status_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/serverstatus/{{ $server_status->server_status_id }}" method="post">
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
          <th class="rug-text-nowrap sortable">Server Status Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $serverstatus->links() }}
@endsection