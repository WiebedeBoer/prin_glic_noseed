@extends('layouts.appmain')
@section('title')
Library Afhankelijkheden
@endsection
<!--name-->
@section('pagename')
Library Afhankelijkheden
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Library Afhankelijkheid Aanmaak</h2>
<p><a href="/libraries/create" class="btn btn-primary">Voeg Library Afhankelijkheid toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Library Afhankelijkheden</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Library Afhankelijkheid Details</th>
          <th class="rug-text-nowrap sortable">Apps</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($libraries as $library) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/libraries/{{ $library->library_id }}">{{ $library->dependency_name }}</a></td> 
        <td class="data-tabel"><a href="/libraries/{{ $library->app_id }}">{{ $library->apps->app_name }}</a></td> 
        <td class="data-tabel"><a href="/libraries/{{ $library->library_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/libraries/{{ $library->library_id }}" method="post">
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
            <th class="rug-text-nowrap sortable">Library Afhankelijkheid Details</th>
            <th class="rug-text-nowrap sortable">Apps</th>
            <th class="rug-text-nowrap sortable">Wijzig</th>
            <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $libraries->links() }}
@endsection