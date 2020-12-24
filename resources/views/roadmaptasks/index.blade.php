@extends('layouts.appmain')
@section('title')
Roadmaps
@endsection
<!--name-->
@section('pagename')
Roadmap Delen
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('hours.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Roadmap Delen Aanmaak</h2>
<p><a href="/roadmaptasks/create" class="btn btn-primary">Voeg roadmap deel toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>Roadmap Delen</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable">Roadmap Deel Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($roadmaptasks as $roadmap) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/roadmaptasks/{{ $roadmap->task_id }}">{{ $roadmap->roadmap_task }}</a></td> 
        <td class="data-tabel"><a href="/roadmaptasks/{{ $roadmap->task_id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/roadmaptasks/{{ $roadmap->task_id }}" method="post">
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
          <th class="rug-text-nowrap sortable">Roadmap Deel Details</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $roadmaptasks->links() }}
@endsection