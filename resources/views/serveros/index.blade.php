@extends('layouts.appmain')
@section('title')
Server Operating System
@endsection
<!--name-->
@section('pagename')
Server Operating System
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Server Operating System Aanmaak</h2>
<p><a href="/serveros/create" class="btn btn-primary">Voeg server OS toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server OS</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server OS Details</th>
          <th class="rug-text-nowrap sortable">Release Datum</th>
          <th class="rug-text-nowrap sortable">End of Support Datum</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($serveros as $server_os) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/serveros/{{ $server_os->server_os_id }}">{{ $server_os->server_os_name }}</a></td>    
        @if($server_os->end_of_support < $ldate)
            <td class="data-tabel" style="color:#ff0000;">{{ $server_os->release }}</td>
            <td class="data-tabel" style="color:#ff0000;">{{ $server_os->end_of_support }}</td>
        @elseif($server_os->end_of_support < $pdate && $server_os->end_of_support >= $ldate)
            <td class="data-tabel" style="color:#ffa500;">{{ $server_os->release }}</td>
            <td class="data-tabel" style="color:#ffa500;">{{ $server_os->end_of_support }}</td>
        @else
            <td class="data-tabel">{{ $server_os->release }}</td>
            <td class="data-tabel">{{ $server_os->end_of_support }}</td>
        @endif
        <td class="data-tabel"><a href="/serveros/{{ $server_os->server_os_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/serveros/{{ $server_os->server_os_id }}" method="post">
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
          <th class="rug-text-nowrap sortable">Server OS Details</th>
          <th class="rug-text-nowrap sortable">Release Datum</th>
          <th class="rug-text-nowrap sortable">End of Support Datum</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $serveros->links() }}
@endsection