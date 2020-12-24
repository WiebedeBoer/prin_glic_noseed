@extends('layouts.appmain')
@section('title')
Applicaties Technisch Beheerders
@endsection
<!--name-->
@section('pagename')
Applicaties Technisch Beheerders
@endsection
<!--includes-->
@section('submenu')
@include('session')
@include('apps.submenu')
@endsection
<!--addcontent-->
@section('addcontent')
<h2>Applicatie Technisch Beheerder Aanmaak</h2>
<p><a href="/apptechadmin/create" class="btn btn-primary">Voeg App Technisch Beheerder toe</a></p>
@endsection
<!--content-->
@section('content')
<h2>App Technisch Beheerders</h2>
<table id="myTable" class="tablesorter table table-striped">
    <thead>
        <tr>
          <th class="rug-text-nowrap sortable"><a href="/persons">App Technisch Beheerder Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App</a></th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
    <tbody>
    @foreach($apptechadmin as $app_techadmin) 
        <tr class="clickable-row">   
        <td class="data-tabel"><a href="/apptechadmin/{{ $app_techadmin->id }}">{{ $app_techadmin->persons->person_name }}</a></td> 
        <td class="data-tabel"><a href="/apps/{{ $app_techadmin->app_id }}">{{ $app_techadmin->apps->app_name }}</a></td> 
        <td class="data-tabel"><a href="/apps/{{ $app_techadmin->app_id }}">{{ $app_techadmin->hours }}</a></td>
        <td class="data-tabel"><a href="/apptechadmin/{{ $app_techadmin->id }}/edit" class="btn btn-secondary">Wijzig</a></td> 
        <td class="data-tabel">
        <form action="/apptechadmin/{{ $app_techadmin->id }}" method="post">
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
          <th class="rug-text-nowrap sortable"><a href="/persons">App Technisch Beheerder Details</a></th>
          <th class="rug-text-nowrap sortable"><a href="/apps">App</a></th>
          <th class="rug-text-nowrap sortable">Uren</th>
          <th class="rug-text-nowrap sortable">Wijzig</th>
          <th class="rug-text-nowrap sortable">Verwijder</th>
        </tr>
    </thead>
</table>
@endsection
@section('listlinks')
    {{ $apptechadmin->links() }}
@endsection