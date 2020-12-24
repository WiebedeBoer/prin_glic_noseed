@extends('layouts.appmain')
@section('title')
Servers en Apps
@endsection
<!--name-->
@section('pagename')
Servers &amp; Apps
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('serverapps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Server en App Registratie</h2>
<p><a href="/serverapps/create" class="btn btn-primary">Voeg app aan server toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Servers &amp; Apps</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable"><a href="/servers">Server Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/languages">Taal en Versie</a></th>
          <th class="rug-text-nowrap sortable"><a href="/frameworks">Framework en Versie</a></th>
          <th class="rug-text-nowrap sortable"><a href="/databases">Database</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($serverapps as $app_server)
        <tr class="clickable-row">
        <!--server naam-->    
        <td class="data-tabel">
        <a href="/serverapps/{{ $app_server->id }}">{{ $app_server->servers->server_name }}</a>
        </td> 
        <!--app naam--> 
        <td class="data-tabel">
        <a href="/serverapps/{{ $app_server->id }}">{{ $app_server->apps->app_name }}</a>
        </td> 
        <!--taal en versie-->
        <td class="data-tabel">{{ $app_server->apps_language->language_name }} {{ $app_server->language_version }}</td>
        <!--framework en versie-->
        <td class="data-tabel">{{ $app_server->apps_framework->framework_name }} {{ $app_server->framework_version }}</td>
        <!--database-->
        <td class="data-tabel">{{ $app_server->apps_database->db_name }}</td>
        <!--wijzig-->
        <td class="data-tabel">
        <a href="/serverapps/{{ $app_server->id }}/edit" class="btn btn-secondary">Wijzig</a>
        </td> 
         <!--verwijder-->
        <td class="data-tabel">
        <form action="/serverapps/{{ $app_server->id }}" method="post">
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
          <th class="rug-text-nowrap sortable"><a href="/servers">Server Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/languages">Taal en Versie</a></th>
          <th class="rug-text-nowrap sortable"><a href="/frameworks">Framework en Versie</a></th>
          <th class="rug-text-nowrap sortable"><a href="/databases">Database</a></th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $serverapps->links() }}
@endsection