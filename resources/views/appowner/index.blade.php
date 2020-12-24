@extends('layouts.appmain')
@section('title')
Applicaties Eigenaar
@endsection
<!--name-->
@section('pagename')
Applicaties Eigenaren
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Applicatie Eigenaar Aanmaak</h2>
<p><a href="/appowner/create" class="btn btn-primary">Voeg app eigenaar toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Eigenaren</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable"><a href="/persons">App Eigenaar Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App</a></th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($appowner as $app_owner) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/appowner/{{ $app_owner->id }}">{{ $app_owner->persons->person_name }}</a></td> 
        <td class="data-tabel"><a href="/apps/{{ $app_owner->app_id }}">{{ $app_owner->apps->app_name }}</a></td> 
        <td class="data-tabel"><a href="/apps/{{ $app_owner->app_id }}">{{ $app_owner->hours }}</a></td>
        <td class="data-tabel"><a href="/appowner/{{ $app_owner->id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/appowner/{{ $app_owner->id }}" method="post">
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
          <th class="rug-text-nowrap sortable"><a href="/persons">App Eigenaar Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App</a></th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $appowner->links() }}
@endsection