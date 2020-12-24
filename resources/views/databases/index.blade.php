@extends('layouts.appmain')
@section('title')
Database Types Afhankelijkheden
@endsection
<!--name-->
@section('pagename')
Database Types Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Database Type Afhankelijkheid Aanmaak</h2>
<p><a href="/databases/create" class="btn btn-primary">Voeg Database Type Afhankelijkheid toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Database Types Afhankelijkheden</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Database Type Afhankelijkheid Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($databases as $database) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/databases/{{ $database->db_id }}">{{ $database->db_name }}</a></td> 
        <td class="data-tabel"><a href="/databases/{{ $database->db_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/databases/{{ $database->db_id }}" method="post">
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
        <th class="rug-text-nowrap sortable">Database Type Afhankelijkheid Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $databases->links() }}
@endsection