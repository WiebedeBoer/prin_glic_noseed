@extends('layouts.appmain')
@section('title')
Server Type
@endsection
<!--name-->
@section('pagename')
Server Type
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('servers.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Server Type Aanmaak</h2>
<p><a href="/servertype/create" class="btn btn-primary">Voeg server type toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Server types</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Server type Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($servertype as $server_type) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/servertype/{{ $server_type->server_type_id }}">{{ $server_type->server_type }}</a></td> 
        <td class="data-tabel"><a href="/servertype/{{ $server_type->server_type_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/servertype/{{ $server_type->server_type_id }}" method="post">
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
          <th class="rug-text-nowrap sortable">Server type Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $servertype->links() }}
@endsection