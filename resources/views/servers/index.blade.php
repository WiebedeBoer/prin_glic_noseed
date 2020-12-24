@extends('layouts.appmain')
@section('title')
Servers
@endsection
<!--name-->
@section('pagename')
Servers
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Server Registratie</h2>
<p><a href="/servers/create" class="btn btn-primary" class="btn btn-primary">Voeg server toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Servers</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable"><a href="/servers">Server Details</a>
          <a href="/servers/?sort=server_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverstatus">Server Status</a>
          <a href="/servers/?sort=server_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serveros">Server OS</a>
          <a href="/servers/?sort=server_operating_system"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverapps">Aantal Apps</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($servers as $registered_server)
        <tr class="clickable-row">    
        <td>
        <a href="/servers/{{ $registered_server->server_id }}">{{ $registered_server->server_name }}</a>
        </td>    
        @if($registered_server->servers_os->end_of_support < $ldate)
            <td class="data-tabel" style="color:#ff0000;">{{ $registered_server->servers_status->server_status }}</td>
            <td class="data-tabel" style="color:#ff0000;">{{ $registered_server->servers_os->server_os_name }}</td>
        @elseif($registered_server->servers_os->end_of_support < $pdate && $registered_server->servers_os->end_of_support >= $ldate)
            <td class="data-tabel" style="color:#ffa500;">{{ $registered_server->servers_status->server_status }}</td>
            <td class="data-tabel" style="color:#ffa500;">{{ $registered_server->servers_os->server_os_name }}</td>        
        @else
            <td class="data-tabel">{{ $registered_server->servers_status->server_status }}</td>
            <td class="data-tabel">{{ $registered_server->servers_os->server_os_name }}</td>
        @endif
        <td class="data-tabel">{{ $registered_server->serverapps_count->count() }}</td>
        <td class="data-tabel">
        <a href="/servers/{{ $registered_server->server_id }}/edit" class="btn btn-secondary">Wijzig</a>
        </td> 
        <td class="data-tabel">
        <form action="/servers/{{ $registered_server->server_id }}" method="post">
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
          <th class="rug-text-nowrap sortable"><a href="/servers">Server Details</a>
          <a href="/servers/?sort=server_name"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverstatus">Server Status</a>
          <a href="/servers/?sort=server_status"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serveros">Server OS</a>
          <a href="/servers/?sort=server_operating_system"><img src="{{ asset('assets/images/arrow-down-black.png') }}"></a>
          </th>
          <th class="rug-text-nowrap sortable"><a href="/serverapps">Aantal Apps</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $servers->links() }}
@endsection