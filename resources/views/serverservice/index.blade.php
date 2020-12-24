@extends('layouts.appmain')
@section('title')
Server Service
@endsection
<!--name-->
@section('pagename')
Server Service
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Server Service Aanmaak</h2>
<p><a href="/serverservice/create" class="btn btn-primary">Voeg server Service toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server Service</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server service Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($serverservice as $server_service) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/serverservice/{{ $server_service->server_service_id }}">{{ $server_service->server_service }}</a></td> 
        <td class="data-tabel"><a href="/serverservice/{{ $server_service->server_service_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/serverservice/{{ $server_service->server_service_id }}" method="post">
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
          <th class="rug-text-nowrap sortable">Server service Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $serverservice->links() }}
@endsection