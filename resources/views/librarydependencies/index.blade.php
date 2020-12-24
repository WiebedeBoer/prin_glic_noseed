@extends('layouts.appmain')
@section('title')
Library Afhankelijkheden binnen Framework
@endsection
<!--name-->
@section('pagename')
Library Afhankelijkheden binnen Framework
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Library Afhankelijkheid binnen Framework Aanmaak</h2>
<p><a href="/librarydependencies/create" class="btn btn-primary">Voeg Library Afhankelijkheid binnen Framework toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Library binnen Framework Afhankelijkheden</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Library Afhankelijkheid binnen Framework Details</th>
          <th class="rug-text-nowrap sortable">Library</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($libraries as $library) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/librarydependencies/{{ $library->library_id }}">{{ $library->dependency_name }}</a></td> 
        <td class="data-tabel"><a href="/librarydependencies/{{ $library->app_id }}">{{ $library->libraries->dependency_name }}</a></td> 
        <td class="data-tabel"><a href="/librarydependencies/{{ $library->library_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/librarydependencies/{{ $library->library_id }}" method="post">
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
            <th class="rug-text-nowrap sortable">Library Afhankelijkheid binnen Framework Details</th>
            <th class="rug-text-nowrap sortable">Library</th>
            <th class="rug-text-nowrap sortable">Wijzig</th>
            <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $libraries->links() }}
@endsection