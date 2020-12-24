@extends('layouts.appmain')
@section('title')
Roadmaps
@endsection
<!--name-->
@section('pagename')
Roadmaps
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Roadmap Aanmaak</h2>
<p><a href="/roadmaps/create" class="btn btn-primary">Voeg roadmap toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Apps Status</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Roadmap Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roadmaps as $roadmap) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/roadmaps/{{ $roadmap->roadmap_id }}">{{ $roadmap->roadmap_update }}</a></td> 
        <td class="data-tabel"><a href="/roadmaps/{{ $roadmap->roadmap_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/roadmaps/{{ $roadmap->roadmap_id }}" method="post">
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
          <th class="rug-text-nowrap sortable">Roadmap Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $roadmaps->links() }}
@endsection