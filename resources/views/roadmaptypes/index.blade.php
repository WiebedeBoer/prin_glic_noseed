@extends('layouts.appmain')
@section('title')
Roadmaps
@endsection
<!--name-->
@section('pagename')
Roadmap Types
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Roadmap Type Aanmaak</h2>
<p><a href="/roadmaptypes/create" class="btn btn-primary">Voeg roadmap type toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Roadmap Types</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Roadmap Type Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roadmaptypes as $roadmap) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/roadmaptypes/{{ $roadmap->id }}">{{ $roadmap->roadmap_update }}</a></td> 
        <td class="data-tabel"><a href="/roadmaptypes/{{ $roadmap->id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/roadmaptypes/{{ $roadmap->id }}" method="post">
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
          <th class="rug-text-nowrap sortable">Roadmap Type Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $roadmaptypes->links() }}
@endsection